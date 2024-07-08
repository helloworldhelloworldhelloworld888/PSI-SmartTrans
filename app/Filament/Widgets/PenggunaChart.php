<?php

namespace App\Filament\Widgets;

use App\Models\Pengguna;
use App\Traits\RandomColor;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class PenggunaChart extends ChartWidget
{
    protected static ?string $heading = 'Pengguna';

    protected static ?string $pollingInterval = '360s';

    protected function getOptions(): array | RawJs | null
    {
        return RawJs::from(<<<JS
{
    plugins: {
        legend: {
            position: 'right',
            boxWidth: 20,
            labels: {
                usePointStyle: true,
                font: {
                    size: 16,
                },
                generateLabels: function(chart) {
                    var data = chart.data;
                    if (data.labels.length && data.datasets.length) {
                        return data.labels.map(function(label, i) {
                            var meta = chart.getDatasetMeta(0);
                            var total = meta.total;
                            var value = data.datasets[0].data[i];
                            var percentage = Math.round((value / total) * 100);
                            return {
                                text: label.toLowerCase().replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); }) + ' (' + percentage + '%)',
                                fillStyle: data.datasets[0].backgroundColor[i],
                                hidden: isNaN(data.datasets[0].data[i]) || meta.data[i].hidden,
                                index: i
                            };
                        });
                    }
                    return [];
                }
            }
        },
    },
    scales: {
        y: {
            display: false,
        },
        x: {
            display: false,
        },
    },
}
JS);
    }

    protected function getData(): array
    {
        $dataPengguna = Pengguna::where('jenis_akun', '!=', 'admin')->get()
            ->groupBy('jenis_akun');

        return [
            'datasets' => [
                [
                    'data' => $dataPengguna->map(fn ($item) => $item->count())->values(),
                    'backgroundColor' => $dataPengguna->map(fn ($item) => RandomColor::getRandomColorBasedOnPrimary())->values(),
                ],
            ],
            'labels' => $dataPengguna->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
