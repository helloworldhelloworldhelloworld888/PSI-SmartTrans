<?php

namespace App\Filament\Resources\HalteResource\Pages;

use App\Filament\Resources\HalteResource;
use Filament\Resources\Pages\ListRecords;

class ListHaltes extends ListRecords
{
    protected static string $resource = HalteResource::class;

    protected function getHeaderWidgets(): array
    {
        return HalteResource::getWidgets();
    }
}
