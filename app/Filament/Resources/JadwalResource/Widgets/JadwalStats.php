<?php

namespace App\Filament\Resources\JadwalResource\Widgets;

use App\Models\Jadwal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JadwalStats extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Bis', Jadwal::select('bis_id')->distinct()->count()),
        ];
    }
}
