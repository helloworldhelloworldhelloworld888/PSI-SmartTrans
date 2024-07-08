<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BisResource\Pages;
use App\Filament\Resources\BisResource\Widgets\BisStats;
use App\Models\Bis;
use App\Models\Rute;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BisResource extends Resource
{
    const NAME = 'Bis';

    protected static ?string $model = Bis::class;

    protected static ?string $navigationIcon = 'bis';

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'bus';

    protected static ?string $recordTitleAttribute = 'kode_bis';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?int $navigationSort = 4;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Bis')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_rute')
                    ->label('ID Rute')
                    ->description(fn ($record) => $record->rute?->nama_rute)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_bis')
                    ->label('Kode Bis')
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
                        TextInput::make('kode_bis')
                            ->label('Kode Bis')
                            ->required(),
                        Select::make('id_rute')
                            ->label('Rute')
                            ->options(Rute::all()->pluck('nama_rute', 'id')->mapWithKeys(fn ($namaRute, $id) => [$id => $id . ' (' . $namaRute . ')']))
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
            'index' => Pages\ListBis::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BisStats::class,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['rute', 'jadwal']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['kode_bis'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $jamKeberangkatan = $record->jadwal?->jamKeberangkatan;

        return [
            'Rute' => $record->rute?->nama_rute,
            'Halte Awal' => $record->rute?->halteAwal?->nama_halte,
            'Halte Akhir' => $record->rute?->halteAkhir?->nama_halte,
            'Jam Keberangkatan' => $jamKeberangkatan ? implode(', ', $jamKeberangkatan) : '-',
        ];
    }
}
