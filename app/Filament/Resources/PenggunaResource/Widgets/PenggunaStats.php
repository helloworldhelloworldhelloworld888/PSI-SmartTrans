<?php

namespace App\Filament\Resources\PenggunaResource\Widgets;

use App\Models\Pengguna;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PenggunaStats extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    protected function getStats(): array
    {
        $pengguna = Pengguna::where('jenis_akun', '!=', 'admin')->get();

        $stats = [
            Stat::make('Total Pengguna', $pengguna->count()),
        ];

        $groupedPengguna = $pengguna->groupBy('jenis_akun');

        foreach ($groupedPengguna as $jenisAkun => $group) {
            $stats[] = Stat::make(ucwords($jenisAkun), $group->count());
        }

        return $stats;
    }
}
