<?php

namespace App\Filament\Resources\AnalisisLlmResource\Pages;

use App\Filament\Resources\AnalisisLlmResource;
use App\Settings\AnalisisSetting;
use Exception;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LucianoTonet\GroqLaravel\Facades\Groq;
use Throwable;

class CreateAnalisisLlm extends CreateRecord
{
    protected static string $resource = AnalisisLlmResource::class;

    public function mount(): void
    {
        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();

        $this->data['dataset'] = app(AnalisisSetting::class)->defaultDataSet;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->startWith($data['parameters'], 'Data ')) {
            $data['parameters'] = str_replace('Data ', '', $data['parameters']);
        }
        $opsi = [
           // 'system' => $data['system'],
            'token' => $data['token'],
            'temperature' => $data['temperature'],
        ];

        $data['dataset'] = str_replace('[dataset]', implode(' ', $this->generateDataset($data['parameters'])), $data['dataset']);
        $content = $this->generateGroq($data['model'], $data['dataset'], $opsi);
        $data['content'] = $content;
        $data['title'] = 'Analisis ' . $data['parameters'] . ' ' . $data['model'] . ' ' . now()->format('Y-m-d H:i:s');
        $data['slug'] = Str::slug($data['title']);
        if (empty($content)) {
            throw new Halt('Failed to generate content for the analysis. Please try again.');
        }
        unset($data['system']);

        return $data;
    }

    protected function getCreatedNotificationMessage(): ?string
    {
        return 'Analisis berhasil dibuat.';
    }

    protected function generateGroq($model, $dataset, $opsi = [])
    {
        $system = $opsi['system'] ?? null;
        $token = $opsi['token'] ?? 1024;
        $temperature = $opsi['temperature'] ?? 1;

        try {
            $groq = new Groq();
            $message = [];
            if ($system) {
                $message[] = [
                    'role' => 'system',
                    'content' => $system,
                ];
            }
            $message[] = [
                'role' => 'user',
                'content' => $dataset,
            ];

            $chatCompletion = $groq->chat()->completions()->create([
                'model' => $model,
                'messages' => $message,
                'temperature' => $temperature,
                'max_tokens' => $token,
            ]);

            return $chatCompletion['choices'][0]['message']['content'];
        } catch (Exception $e) {
            $this->dispatch('error', $e->getMessage());

            throw new Halt($e->getMessage());
        } catch (Throwable $e) {
            $this->dispatch('error', $e->getMessage());

            throw new Halt($e->getMessage());
        }
    }

    protected function startWith($string, $startString)
    {
        $len = strlen($startString);

        return substr($string, 0, $len) == $startString;
    }

    protected function generateDataset($parameters)
    {
        $filteredTables = [$parameters];
        if ($parameters === 'Semua Data') {
            $filteredTables = $this->getFilteredTables();
        }

        return $this->generateStatementSql($filteredTables);
    }

    protected function getFilteredTables()
    {
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        $excludePrefixes = [
            'failed_jobs',
            'migrations',
            'password_resets',
            'personal_access_tokens',
            'sessions',
            'analisis_llm',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'notifications',
            'password_reset_tokens',
        ];

        return array_filter($tables, function ($table) use ($excludePrefixes) {
            foreach ($excludePrefixes as $prefix) {
                if (str_starts_with($table, $prefix)) {
                    return false;
                }
            }

            return true;
        });
    }

    protected function generateStatementSql($filteredTables)
    {
        $sqlStatements = [];

        foreach ($filteredTables as $table) {
            $columns = DB::getSchemaBuilder()->getColumnListing($table);
            $columnList = implode(', ', array_map(fn ($col) => "`$col`", $columns));
            $table = strtolower($table);
            $rows = DB::table($table)->get();

            $valueList = [];
            foreach ($rows as $row) {
                $values = [];
                foreach ($columns as $col) {
                    if ($col === 'created_at' || $col === 'updated_at') {
                        continue;
                    }
                    $values[] = "'" . addslashes($row->$col) . "'";
                }
                $valueList[] = '(' . implode(', ', $values) . ')';
            }

            if (! empty($valueList)) {
                $sql = "INSERT INTO `$table` ($columnList) VALUES " . implode(', ', $valueList) . ';';
                $sqlStatements[] = $sql;
            }
        }

        return $sqlStatements;
    }
}