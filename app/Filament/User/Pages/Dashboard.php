<?php

namespace App\Filament\User\Pages;

use App\Models\Bis;
use App\Models\Halte;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.dashboard';

    public $dataRute;

    public function mount()
    {
        $this->dataRute = Bis::with('rute')->inRandomOrder()->first();
    }

    public static function dataHalte($id)
    {
        return Halte::find($id);
    }
}
