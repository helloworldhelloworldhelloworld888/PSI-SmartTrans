<?php

namespace App\Filament\Resources\JadwalResource\Pages;

use App\Filament\Resources\JadwalResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwals extends ListRecords
{
    protected static string $resource = JadwalResource::class;

    protected function getHeaderWidgets(): array
    {
        return JadwalResource::getWidgets();
    }
}
