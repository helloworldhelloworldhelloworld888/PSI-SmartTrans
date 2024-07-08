<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TransaksiChart extends ChartWidget
{
    protected static ?string $heading = 'Transaksi Per Bulan';

    protected static ?string $pollingInterval = '5s';

    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $transaksiData = Trend::model(Transaksi::class)
            ->dateColumn('tanggal_transaksi')
            ->between(
                start: now()->year(2024)->startOfYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'data' => $transaksiData->map(fn (TrendValue $value) => $value->aggregate)
                        ->toArray(),
                    'fill' => 'start',
                    'label' => 'Transaksi',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}