<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class PembayaranBerhasil extends Page
{
    protected static string $routePath = '/pembayaran-berhasil';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.pembayaran-berhasil';
}
