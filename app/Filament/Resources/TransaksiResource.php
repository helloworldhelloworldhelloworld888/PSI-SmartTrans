<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\Widgets\TransaksiStats;
use App\Models\Bis;
use App\Models\Pengguna;
use App\Models\Transaksi;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransaksiResource extends Resource
{
    const NAME = 'Transaksi';

    protected static ?string $model = Transaksi::class;

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'transaksi';

    protected static ?string $recordTitleAttribute = 'id_pengguna';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?string $navigationIcon = 'transaksi';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Transaksi')
                    ->numeric()
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pengguna')
                    ->label('ID Pengguna')
                    ->description(fn ($record) => '(' . $record->pengguna->nama_lengkap . ')')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_bis')
                    ->label('ID Bis')
                    ->description(fn ($record) => '(' . $record->bis->kode_bis . ')')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal')
                    ->dateTime('d F Y')
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
                SelectFilter::make('id_bis')
                    ->label('ID Bis')
                    ->options(Bis::select('id', 'kode_bis')->get()->pluck('id', 'kode_bis')->mapWithKeys(fn ($id, $kodeBis) => [$id => $id . ' (' . $kodeBis . ')']))
                    ->searchable(),
                Filter::make('tanggal_transaksi')
                    ->form([
                        Group::make([
                            DatePicker::make('created_from')
                                ->label('Dari')
                                ->native(false)
                                ->placeholder('Pilih tanggal awal'),
                            DatePicker::make('created_until')
                                ->label('Sampai')
                                ->native(false)
                                ->placeholder('Pilih tanggal akhir'),
                        ])
                            ->columns(2),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_transaksi', '<=', $date),
                            );
                    }),
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
                        Select::make('id_pengguna')
                            ->label('ID Pengguna')
                            ->searchable()
                            ->options(Pengguna::select('id', 'nama_lengkap')->get()->pluck('id', 'nama_lengkap')->mapWithKeys(fn ($id, $namaLengkap) => [$id => $id . ' (' . $namaLengkap . ')']))
                            ->required(),
                        Select::make('id_bis')
                            ->label('ID Bis')
                            ->searchable()
                            ->options(Bis::select('id', 'kode_bis')->get()->pluck('id', 'kode_bis')->mapWithKeys(fn ($id, $kodeBis) => [$id => $id . ' (' . $kodeBis . ')']))
                            ->required(),
                        DatePicker::make('tanggal_transaksi')
                            ->label('Tanggal')
                            ->native(false)
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
            'index' => Pages\ListTransaksis::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TransaksiStats::class,
        ];
    }
}
