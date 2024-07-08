<?php

namespace App\Filament\Resources\RuteResource\Widgets;

use App\Models\Rute;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RuteStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Rute', Rute::count()),
        ];
    }
}
