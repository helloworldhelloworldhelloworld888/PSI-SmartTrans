<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalResource\Pages;
use App\Filament\Resources\JadwalResource\Widgets\JadwalStats;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalResource extends Resource
{
    const NAME = 'Jadwal';

    const FORMAT_TIME = 'H:i A';

    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'jadwal';

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'jadwal';

    protected static ?string $recordTitleAttribute = 'id_bis';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?int $navigationSort = 5;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Jadwal')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_bis')
                    ->label('ID Bis')
                    ->description(fn ($record) => $record->bis?->kode_bis)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_keberangkatan_1')
                    ->label('Jam Keberangkatan 1')
                    ->date(self::FORMAT_TIME)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_keberangkatan_2')
                    ->label('Jam Keberangkatan 2')
                    ->date(self::FORMAT_TIME)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_keberangkatan_3')
                    ->label('Jam Keberangkatan 3')
                    ->date(self::FORMAT_TIME)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_keberangkatan_4')
                    ->label('Jam Keberangkatan 4')
                    ->date(self::FORMAT_TIME)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('id_bis')
                            ->label('ID Bis')
                            ->disabled(),
                        Forms\Components\TimePicker::make('jam_keberangkatan_1')
                            ->label('Jam Keberangkatan 1')
                            ->required(),
                        Forms\Components\TimePicker::make('jam_keberangkatan_2')
                            ->label('Jam Keberangkatan 2')
                            ->required(),
                        Forms\Components\TimePicker::make('jam_keberangkatan_3')
                            ->label('Jam Keberangkatan 3')
                            ->required(),
                        Forms\Components\TimePicker::make('jam_keberangkatan_4')
                            ->label('Jam Keberangkatan 4')
                            ->required(),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwals::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            JadwalStats::class,
        ];
    }
}
