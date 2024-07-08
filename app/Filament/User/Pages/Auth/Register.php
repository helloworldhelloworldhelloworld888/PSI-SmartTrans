<?php

namespace App\Filament\User\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BasePage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Password;

class Register extends BasePage
{
    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.auth.register';

    protected ?string $maxWidth = 'full';

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getUserAgreementFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('nama_lengkap')
            ->label(__('filament-panels::pages/auth/register.form.name.label'))
            ->placeholder('Masukkan nama lengkap Anda')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::pages/auth/register.form.email.label'))
            ->placeholder('Masukkan alamat email Anda')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel());
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::pages/auth/register.form.password.label'))
            ->password()
            ->placeholder('Masukkan kata sandi Anda')
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->rule(Password::default())
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'));
    }

    protected function getUserAgreementFormComponent(): Component
    {
        return Checkbox::make('user_agreement')
            ->hiddenLabel()
            ->hint(new HtmlString('Dengan membuat akun berarti Anda menyetujui <strong>Syarat dan Ketentuan</strong>, serta <strong>Kebijakan Privasi</strong> kami.'))
            ->accepted()
            ->required()
            ->dehydrated(false);
    }
}
