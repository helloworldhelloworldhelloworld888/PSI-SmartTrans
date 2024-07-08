<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class PenghasilanChart extends ChartWidget
{
    protected static ?string $heading = 'Penghasilan Per Bulan';

    protected static ?string $pollingInterval = '5s';

    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $totalPenghasilanByMonthPelajar = DB::table('transaksi')
            ->join('pengguna', 'transaksi.id_pengguna', '=', 'pengguna.id')
            ->select(DB::raw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan, SUM(CASE WHEN pengguna.jenis_akun = "pelajar" THEN 1000 ELSE 0 END) as totalPenghasilan'))
            ->groupBy('bulan')
            ->get();

        $totalPenghasilanByMonthUmum = DB::table('transaksi')
            ->join('pengguna', 'transaksi.id_pengguna', '=', 'pengguna.id')
            ->select(DB::raw('DATE_FORMAT(tanggal_transaksi, "%Y-%m") as bulan, SUM(CASE WHEN pengguna.jenis_akun = "umum" THEN 3000 ELSE 0 END) as totalPenghasilan'))
            ->groupBy('bulan')
            ->get();

        $monthsPelajar = [
            'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'Jun' => 0,
            'Jul' => 0, 'Aug' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0,
        ];

        $monthsUmum = [
            'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0, 'May' => 0, 'Jun' => 0,
            'Jul' => 0, 'Aug' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0,
        ];

        // 
        foreach ($totalPenghasilanByMonthPelajar as $data) {
            $monthName = date('M', strtotime($data->bulan . '-01')); 
            $monthsPelajar[$monthName] = $data->totalPenghasilan;
        }

        foreach ($totalPenghasilanByMonthUmum as $data) {
            $monthName = date('M', strtotime($data->bulan . '-01')); 
            $monthsUmum[$monthName] = $data->totalPenghasilan;
        }

        // Create collections from the processed data
        $transaksiDataPelajar = collect($monthsPelajar)->map(function ($value, $key) {
            return new TrendValue(
                aggregate: $value,
                date: $key,
            );
        });

        $transaksiDataUmum = collect($monthsUmum)->map(function ($value, $key) {
            return new TrendValue(
                aggregate: $value,
                date: $key,
            );
        });

        return [
            'datasets' => [
                [
                    'label' => 'Pelajar',
                    'data' => $transaksiDataPelajar->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
                    'backgroundColor' => 'rgba(0, 71, 255, 0.76)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Umum',
                    'data' => $transaksiDataUmum->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
                    'backgroundColor' => 'rgba(255, 0, 0, 0.7)',
                    'borderColor' => 'rgba(235, 0, 0, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => array_keys($monthsPelajar), 
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => true,
                ],
                'y' => [
                    'stacked' => true,
                ],
            ],
        ];
    }
}
?>
