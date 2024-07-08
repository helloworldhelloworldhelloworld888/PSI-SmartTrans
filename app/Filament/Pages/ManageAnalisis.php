<?php

namespace App\Filament\Pages;

use App\Settings\AnalisisSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAnalisis extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = AnalisisSetting::class;

    protected static ?string $navigationGroup = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Analisis AI')
                    ->schema([
                        Forms\Components\MarkdownEditor::make('defaultDataSet')
                            ->label('Dataset Default')
                            ->helperText('Atur promt sesuai yang Anda sering berikan kepada AI')
                            ->hint('[dataset] = data parameters yang Anda inputkan.')
                            ->disableAllToolbarButtons()
                            ->required(),
                    ]),
            ]);
    }
}
