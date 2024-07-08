<?php

namespace App\Filament\Resources\BisResource\Pages;

use App\Filament\Resources\BisResource;
use Filament\Resources\Pages\ListRecords;

class ListBis extends ListRecords
{
    protected static string $resource = BisResource::class;

    protected function getHeaderWidgets(): array
    {
        return BisResource::getWidgets();
    }
}
