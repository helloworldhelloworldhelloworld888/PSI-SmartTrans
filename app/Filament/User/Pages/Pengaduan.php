<?php

namespace App\Filament\User\Pages;

use App\Enums\TopikEnum;
use Filament\Pages\Page;

class Pengaduan extends Page
{
    protected static string $routePath = '/pengaduan';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.pengaduan';

    public $topiks = [];

    public function mount()
    {
        $this->topiks = [
            TopikEnum::Transportasi,
            TopikEnum::Halte,
            TopikEnum::Jadwal,
            TopikEnum::Pembayaran,
            TopikEnum::Rute,
            TopikEnum::Lainnya,
        ];
    }
}
