<?php

namespace App\Filament\User\Pages;

use App\Models\Bis;
use App\Models\Rute as ModelsRute;
use Filament\Pages\Dashboard as BasePage;

class Rute extends BasePage
{
    protected static string $routePath = '/rute';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.rute';

    public $dataRute;

    public $ruteChoice;

    public $data = null;

    public function mount()
    {
        $this->dataRute = ModelsRute::all();
    }

    public function cariRute()
    {
        $this->validate([
            'ruteChoice' => ['required', 'exists:rute,id'],
        ], [
            'ruteChoice.required' => 'Pilih rute terlebih dahulu',
            'ruteChoice.exists' => 'Rute tidak ditemukan',
        ]);

        $this->data = Bis::with(['jadwal', 'rute'])
            ->where('id_rute', $this->ruteChoice)->first();
    }
}
