<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class Qr extends Page
{
    protected static string $routePath = '/qr';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.qr';

    public $label = 'Naik';

    public function triggerButton()
    {
        $this->label = $this->label === 'Naik' ? 'Turun' : 'Naik';
    }
}
