<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class QrList extends Page
{
    protected static string $routePath = '/qr-list';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.qr-list';
}
