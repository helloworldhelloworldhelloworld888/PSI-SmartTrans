<?php

namespace App\Filament\Resources\AnalisisLlmResource\Pages;

use App\Filament\Exports\AnalisisLLMExporter;
use App\Filament\Resources\AnalisisLlmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnalisisLlms extends ListRecords
{
    protected static string $resource = AnalisisLlmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ExportAction::make()
                ->label('Export')
                ->icon('heroicon-o-cloud-arrow-down')
                ->exporter(AnalisisLLMExporter::class),
        ];
    }
}
