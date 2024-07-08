<?php

namespace App\Filament\User\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Password;
use Throwable;

use function Filament\Support\is_app_url;

class Profile extends BaseEditProfile
{
    protected static string $routePath = '/profile';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.profile';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getJenisKelaminFormComponent(),
                $this->getNomorTeleponFormComponent(),
                $this->getEmailFormComponent(),
                $this->getJenisAkunFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getPinFormComponent(),
                $this->getPinConfirmationFormComponent(),
            ])
            ->statePath('data');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        unset($data['pin']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! isset($data['pin'])) {
            $data['pin'] = auth()->user()->pin;
        }

        return $data;
    }

    public function save(): void
    {
        try {
            DB::beginTransaction();

            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $this->handleRecordUpdate($this->getUser(), $data);

            $this->callHook('afterSave');

            DB::commit();
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                DB::rollBack() :
                DB::commit();

            return;
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put([
                'password_hash_' . Filament::getAuthGuard() => $data['password'],
            ]);
        }

        $this->data['password'] = null;
        $this->data['passwordConfirmation'] = null;
        $this->data['pin'] = null;
        $this->data['pinConfirmation'] = null;

        $this->getSavedNotification()?->send();

        if ($redirectUrl = $this->getRedirectUrl()) {
            $this->redirect($redirectUrl, navigate: FilamentView::hasSpaMode() && is_app_url($redirectUrl));
        }
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::pages/auth/edit-profile.form.password.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->rule(Password::default())
            ->autocomplete('new-password')
            ->dehydrated(fn ($state): bool => filled($state))
            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
            ->live(debounce: 500)
            ->same('passwordConfirmation');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::pages/auth/edit-profile.form.password_confirmation.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->visible(fn (Get $get): bool => filled($get('password')))
            ->dehydrated(false);
    }

    protected function getPinFormComponent(): Component
    {
        return TextInput::make('pin')
            ->label('Pin Baru')
            ->password()
            ->maxLength(6)
            ->minLength(6)
            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('new-pin')
            ->dehydrated(fn ($state): bool => filled($state))
            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
            ->live(debounce: 500)
            ->same('pinConfirmation');
    }

    protected function getPinConfirmationFormComponent(): Component
    {
        return TextInput::make('pinConfirmation')
            ->label('Konfirmasi Pin')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->visible(fn (Get $get): bool => filled($get('pin')))
            ->dehydrated(false);
    }

    protected function getJenisKelaminFormComponent(): Component
    {
        return ToggleButtons::make('jenis_kelamin')
            ->options([
                'laki-laki' => 'Laki-laki',
                'perempuan' => 'Perempuan',
            ])
            ->inline();
    }

    protected function getNomorTeleponFormComponent(): Component
    {
        return TextInput::make('nomor_telepon')
            ->label('Nomor Telepon')
            ->tel()
            ->placeholder('Masukkan nomor telepon');
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('nama_lengkap')
            ->label('Nama Lengkap')
            ->required()
            ->maxLength(255)
            ->placeholder('Masukkan nama lengkap Anda')
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255)
            ->placeholder('Masukkan email Anda')
            ->unique(ignoreRecord: true);
    }

    protected function getJenisAkunFormComponent(): Component
    {
        return ToggleButtons::make('jenis_akun')
            ->label('Apakah Anda seorang pelajar?')
            ->options([
                'pelajar' => 'Ya',
                'umum' => 'Tidak',
            ])
            ->required()
            ->helperText(new HtmlString('*Silahkan <a href="" class="text-blue-600">verifikasi akun</a> jika Anda seorang pelajar'))
            ->inline();
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Simpan')
            ->submit('save')
            ->extraAttributes([
                'class' => 'w-1/2 place-self-center mb-4',
            ])
            ->keyBindings(['mod+s']);
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
