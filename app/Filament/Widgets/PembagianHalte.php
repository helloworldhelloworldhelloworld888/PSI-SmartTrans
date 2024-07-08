<?php

namespace App\Filament\Widgets;

use App\Models\Halte;
use Filament\Widgets\ChartWidget;
use App\Traits\RandomColor;

class PembagianHalte extends ChartWidget
{
    protected static ?string $heading = 'Total Halte Per Kabupaten/Kota';

    protected static ?string $pollingInterval = '360s';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $dataHalte = Halte::selectRaw('kabupaten, count(*) as total')
            ->groupBy('kabupaten')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Penyebaran Halte',
                    'data' => $dataHalte->pluck('total'),
                    'borderColor' => 'transparent',
                    'backgroundColor' => $dataHalte->map(fn ($item) => RandomColor::getRandomColorBasedOnPrimary())->values(),
                ],
            ],
            'labels' => $dataHalte->pluck('kabupaten'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
