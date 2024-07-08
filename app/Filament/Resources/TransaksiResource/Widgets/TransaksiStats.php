<?php

namespace App\Filament\Resources\TransaksiResource\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TransaksiStats extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    protected function getStats(): array
    {
        $transaksi = Transaksi::all();
        $totalPenghasilan = DB::table('transaksi')
            ->join('pengguna', 'transaksi.id_pengguna', '=', 'pengguna.id')
            ->select(
                DB::raw('SUM(CASE WHEN pengguna.jenis_akun = "pelajar" THEN 1000 ELSE 0 END) as totalPenghasilanPelajar'),
                DB::raw('SUM(CASE WHEN pengguna.jenis_akun = "umum" THEN 3000 ELSE 0 END) as totalPenghasilanUmum')
            )
            ->first();

        $totalPenghasilanRupiah = $totalPenghasilan->totalPenghasilanPelajar + $totalPenghasilan->totalPenghasilanUmum;

        return [
            Stat::make('Total Transaksi', $transaksi->count()),
            Stat::make('Total Penghasilan Pelajar', 'Rp. ' . number_format($totalPenghasilan->totalPenghasilanPelajar, 0, ',', '.')),
            Stat::make('Total Penghasilan Umum', 'Rp. ' . number_format($totalPenghasilan->totalPenghasilanUmum, 0, ',', '.')),
            Stat::make('Total Penghasilan', 'Rp. ' . number_format($totalPenghasilanRupiah, 0, ',', '.')),
        ];
    }
}
?>
