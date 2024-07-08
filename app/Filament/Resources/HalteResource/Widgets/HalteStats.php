<?php

namespace App\Filament\Resources\HalteResource\Widgets;

use App\Models\Halte;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HalteStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Halte', Halte::count()),
        ];
    }
}
