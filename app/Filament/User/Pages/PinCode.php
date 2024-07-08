<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class PinCode extends Page
{
    protected static string $routePath = '/pin';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.pin-code';

    #[On('pinCompleted')]
    public function pinCompleted($pin)
    {
        $user = auth()->user();

        if (! $user->pin) {
            $this->addError('pin', 'PIN Anda belum diatur. Silakan atur PIN terlebih dahulu di halaman profil.');

            return;
        }
        if (! Hash::check($pin, $user->pin)) {
            $this->addError('pin', 'PIN yang Anda masukkan salah.');

            return;
        }

        $this->redirect(route('filament.user.pages.pembayaran-berhasil'));
    }
}
