<?php

namespace App\Filament\Resources\BisResource\Widgets;

use App\Models\Bis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BisStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Bis', Bis::count()),
        ];
    }
}
