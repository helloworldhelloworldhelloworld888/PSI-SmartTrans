<?php

namespace App\Filament\User\Pages;

use App\Models\Pengaduan;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

class FormPengaduan extends Page
{
    use InteractsWithForms;

    #[Url]
    public $topik;

    public ?array $data = [];

    protected static string $routePath = '/pengaduan/tambah';

    protected static string $layout = 'components.layouts.guest';

    protected static string $view = 'filament.user.pages.form-pengaduan';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('topik')
                    ->content($this->topik),
                MarkdownEditor::make('pesan')
                    ->label('Tuliskan keluhan Anda')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'undo',
                    ])
                    ->placeholder('Tuliskan keluhan Anda disini')
                    ->required(),
                FileUpload::make('dokumen')
                    ->label('Dokumen Pendukung')
                    ->image()
                    ->imageEditor()
                    ->placeholder('Unggah dokumen pendukung Anda disini')
                    ->maxSize(10480)
                    ->helperText('Maksimal ukuran file 10MB'),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $data['topik'] = $this->topik;
        $data['id_pengguna'] = auth()->id();

        $this->validate([
            'topik' => 'required',
        ]);

        $pengaduan = DB::transaction(function () use ($data) {
            return Pengaduan::create($data);
        });

        $this->getNotification();

        $this->redirect(
            route('filament.user.pages.pengaduan'),
            navigate: FilamentView::hasSpaMode()
        );
    }

    protected function getNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title('Pengaduan anda berhasil dikirim');
    }
}
