<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HalteResource\Pages;
use App\Filament\Resources\HalteResource\Widgets\HalteStats;
use App\Models\Halte;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HalteResource extends Resource
{
    const NAME = 'Halte';

    protected static ?string $model = Halte::class;

    protected static ?string $navigationIcon = 'halte';

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'halte';

    protected static ?string $recordTitleAttribute = 'nama_halte';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?int $navigationSort = 6;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Halte')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_halte')
                    ->label('Nama Halte')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->label('Kabupaten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->label('Kecamatan')
                    ->searchable()
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
                SelectFilter::make('kabupaten')
                    ->options(fn () => Halte::pluck('kabupaten', 'kabupaten')->toArray())
                    ->searchable(),
                SelectFilter::make('kecamatan')
                    ->options(fn () => Halte::pluck('kecamatan', 'kecamatan')->toArray())
                    ->searchable(),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(2)
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
                        TextInput::make('nama_halte')
                            ->label('Nama Halte')
                            ->required(),
                        TextInput::make('kabupaten')
                            ->label('Kabupaten')
                            ->required(),
                        TextInput::make('kecamatan')
                            ->label('Kecamatan')
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
            'index' => Pages\ListHaltes::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            HalteStats::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_halte', 'kabupaten', 'kecamatan'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Nama Halte' => $record->nama_halte,
            'Kabupaten' => $record->kabupaten,
            'Kecamatan' => $record->kecamatan,
            'Rute' => $record->rute->count() . ' rute',
        ];
    }
}
