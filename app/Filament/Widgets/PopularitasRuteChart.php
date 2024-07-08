<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use App\Traits\RandomColor;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\DB;

class PopularitasRuteChart extends ChartWidget
{
    protected static ?string $heading = 'Popularitas Rute';

    protected static ?string $pollingInterval = '360s';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '260px';

    protected static ?array $options = [
        'scales' => [
            'x' => [
                'display' => false,
            ],
        ],
    ];

    public function getDescription(): string | Htmlable | null
    {
        return '-';
    }

    protected function getData(): array
    {
        $data = Transaksi::join('bis', 'transaksi.id_bis', '=', 'bis.id')
            ->join('rute', 'bis.id_rute', '=', 'rute.id')
            ->select('rute.nama_rute', DB::raw('COUNT(transaksi.id) as jumlah_transaksi'))
            ->groupBy('rute.nama_rute')
            ->orderBy('jumlah_transaksi', 'DESC')
            ->get();

        $datasets = [];
        foreach ($data as $item) {
            $datasets[] = [
                'label' => $item->nama_rute,
                'data' => [$item->jumlah_transaksi],
                'backgroundColor' => RandomColor::getRandomColorBasedOnPrimary(),
                'borderColor' => 'transparent',
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => [''],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
