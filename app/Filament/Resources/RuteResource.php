<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuteResource\Pages;
use App\Filament\Resources\RuteResource\Widgets\RuteStats;
use App\Models\Halte;
use App\Models\Rute;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class RuteResource extends Resource
{
    const NAME = 'Rute';

    protected static ?string $model = Rute::class;

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'rute';

    protected static ?string $recordTitleAttribute = 'nama_rute';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?string $navigationIcon = 'rute';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Rute')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_rute')
                    ->label('Nama Rute')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_halte_awal')
                    ->label('ID Halte Awal')
                    ->description(fn ($record) => $record->halteAwal?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_akhir')
                    ->label('ID Halte Akhir')
                    ->description(fn ($record) => $record->halteAkhir?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_1')
                    ->label('ID Halte 1')
                    ->description(fn ($record) => $record->halteById(1)->first()?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_2')
                    ->label('ID Halte 2')
                    ->description(fn ($record) => $record->halteById(2)->first()?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_3')
                    ->label('ID Halte 3')
                    ->description(fn ($record) => $record->halteById(3)->first()?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_4')
                    ->label('ID Halte 4')
                    ->description(fn ($record) => $record->halteById(4)->first()?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_halte_5')
                    ->label('ID Halte 5')
                    ->description(fn ($record) => $record->halteById(5)->first()?->nama_halte)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->tooltip(fn ($record) => $record->status ? 'Rute Aktif' : 'Rute Tidak Aktif')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('id_halte_awal')
                    ->label('Halte Awal')
                    ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                    ->searchable(),
                SelectFilter::make('id_halte_akhir')
                    ->label('Halte Akhir')
                    ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                    ->searchable(),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(2)
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('nama_rute')
                            ->label('Nama Rute')
                            ->required(),
                        Select::make('id_halte_awal')
                            ->label('Halte Awal')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_akhir')
                            ->label('Halte Akhir')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_1')
                            ->label('Halte 1')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_2')
                            ->label('Halte 2')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_3')
                            ->label('Halte 3')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_4')
                            ->label('Halte 4')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                        Select::make('id_halte_5')
                            ->label('Halte 5')
                            ->options(fn () => Halte::pluck('nama_halte', 'id')->toArray())
                            ->required(),
                    ]),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            RuteStats::make(),
        ];
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
            'index' => Pages\ListRutes::route('/'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_rute'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Halte Awal' => $record->halteAwal?->nama_halte ?? 'N/A',
            'Halte Akhir' => $record->halteAkhir?->nama_halte ?? 'N/A',
        ];
    }
}