<?php

namespace App\Filament\Resources\PengaduanResource\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PengaduanStats extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    protected function getStats(): array
    {
        $dataPengaduan = Pengaduan::select('topik')->distinct()->get();
        $pengaduan = Trend::model(Pengaduan::class)
            ->dateColumn('tanggal_pengaduan')
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();
        $stats = [
            Stat::make('Total Pengaduan', Pengaduan::count())
                ->chart(
                    $pengaduan
                        ->map(fn (TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),
        ];

        foreach ($dataPengaduan as $pengaduan) {
            $data = Trend::query(Pengaduan::where('topik', $pengaduan->topik))
                ->dateColumn('tanggal_pengaduan')
                ->between(
                    start: now()->subYear(),
                    end: now(),
                )
                ->perMonth()
                ->count();
            $stats[] = Stat::make(
                $pengaduan->topik->getLabel(),
                $pengaduan->where('topik', $pengaduan->topik)->count()
            )
                ->chart(
                    $data
                        ->map(fn (TrendValue $value) => $value->aggregate)
                        ->toArray()
                );
        }

        return $stats;
    }
}
