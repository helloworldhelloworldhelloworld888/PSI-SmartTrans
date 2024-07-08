<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TopikEnum: string implements HasColor, HasIcon, HasLabel
{
    case Transportasi = 'transportasi';
    case Jadwal = 'jadwal';
    case Rute = 'rute';
    case Halte = 'halte';
    case Pembayaran = 'pembayaran';
    case Lainnya = 'lainnya';

    public function getLabel(): string
    {
        return match ($this) {
            self::Transportasi => 'Transportasi',
            self::Jadwal => 'Jadwal',
            self::Rute => 'Rute',
            self::Halte => 'Halte',
            self::Pembayaran => 'Pembayaran',
            self::Lainnya => 'Lainnya',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Transportasi => 'info',
            self::Jadwal => 'success',
            self::Rute => 'warning',
            self::Halte => 'primary',
            self::Pembayaran => 'danger',
            self::Lainnya => 'secondary',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Transportasi => 'heroicon-o-truck',
            self::Jadwal => 'heroicon-o-calendar',
            self::Rute => 'heroicon-o-map',
            self::Halte => 'heroicon-o-map-pin',
            self::Pembayaran => 'heroicon-o-credit-card',
            self::Lainnya => 'heroicon-o-ellipsis-horizontal',
        };
    }
}
