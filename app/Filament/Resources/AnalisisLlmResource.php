<?php

namespace App\Filament\Resources;

use App\Filament\Exports\AnalisisLLMExporter;
use App\Filament\Pages\ManageAnalisis;
use App\Filament\Resources\AnalisisLlmResource\Pages;
use App\Models\Analisis;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class AnalisisLlmResource extends Resource
{
    const NAME = 'AI';

    protected static ?string $model = Analisis::class;

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $slug = 'analisis-llm';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('model')
                            ->label('Model')
                            ->options([
                                'Meta' => [
                                    'llama3-8b-8192' => 'LLaMA3 8b',
                                    'llama3-70b-8192' => 'LLaMA3 70b',
                                ],
                                'Mistral' => [
                                    'mixtral-8x7b-32768' => 'MixTRAL 8x7b',
                                ],
                                'Google' => [
                                    'gemma-7b-it' => 'Gemma 7b',
                                ],
                            ])
                            ->default('llama3-8b-8192')
                            ->suffixIcon('heroicon-o-cpu-chip')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('parameters')
                            ->label('Parameters')
                            ->options(function () {
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
                                    'exports',
                                    'settings',
                                    'imports',
                                    'failed_import_rows',
                                    'filament_exceptions_table',
                                ];

                                $tables = array_filter($tables, function ($table) use ($excludePrefixes) {
                                    foreach ($excludePrefixes as $prefix) {
                                        if (str_starts_with($table, $prefix)) {
                                            return false;
                                        }
                                    }

                                    return true;
                                });
                                $tables = array_map(function ($table) {
                                    return 'Data ' . ucwords(str_replace('_', ' ', $table));
                                }, $tables);
                                $tables = array_merge(['Semua Data'], $tables);

                                return array_combine($tables, $tables);
                            })
                            ->searchable()
                            ->required(),
                        MarkdownEditor::make('dataset')
                            ->label('Prompt')
                            ->disableAllToolbarButtons()
                            ->columnSpanFull()
                            ->hintAction(
                                ActionsAction::make('Ubah Dataset')
                                    ->url(ManageAnalisis::getUrl())
                                    ->openUrlInNewTab()
                            )
                            ->helperText('[dataset]= digunakan untuk analisis.')
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),
                Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('temperature')
                            ->default(1)
                            ->numeric()
                            ->autocomplete(false)
                            ->maxValue(2)
                            ->minValue(0)
                            ->required(),
                        Forms\Components\TextInput::make('token')
                            ->default(1024)
                            ->numeric()
                            ->minValue(0)
                            ->autocomplete(false)
                            ->maxValue(30000)
                            ->required(),
                        /*Forms\Components\MarkdownEditor::make('system')
                            ->label('Role System')
                            ->disableAllToolbarButtons()
                            ->placeholder('Ex: You are an LLM function that utilizes SQL queries to answer questions related to data.')
                            ->columnSpanFull(),*/
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 1]),
                Section::make()
                    ->schema([
                        Placeholder::make('temp')
                            ->label('Temperature')
                            ->content('Kontrol keacak-acakan: menurunkannya menghasilkan penyelesaian yang kurang acak. Ketika suhu mendekati nol, model akan menjadi deterministik dan repetitif.'),
                        Placeholder::make('token_help')
                            ->label('Token')
                            ->content('Jumlah maksimum token yang akan di-generate. Permintaan dapat menggunakan hingga 8192 token yang dibagi antara prompt dan penyelesaian.'),
                        /*Placeholder::make('systemHelp')
                            ->label('Role System')
                            ->content('Peran sistem yang akan digunakan untuk menjalankan analisis. Defaul: null'),*/
                    ]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions(ActionGroup::make([
                ExportAction::make()
                    ->exporter(AnalisisLLMExporter::class),
            ]))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parameters')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnalisisLlms::route('/'),
            'create' => Pages\CreateAnalisisLlm::route('/create'),
            'view' => Pages\PreviewAnalisis::route('/{record}'),
        ];
    }
}
