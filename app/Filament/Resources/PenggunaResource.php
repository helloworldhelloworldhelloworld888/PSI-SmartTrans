<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Filament\Resources\PenggunaResource\Widgets\PenggunaStats;
use App\Models\Pengguna;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PenggunaResource extends Resource
{
    const NAME = 'Data Pengguna';

    protected static ?string $model = Pengguna::class;

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'data-pengguna';

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?string $navigationIcon = 'pengguna';

    protected static ?int $navigationSort = 1;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Pengguna')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('nomor_telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_akun')
                    ->formatStateUsing(fn ($record) => ucwords($record->jenis_akun))
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
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->options(Pengguna::select('jenis_kelamin')
                        ->distinct()->get()->pluck('jenis_kelamin')
                        ->mapWithKeys(fn ($jenisKelamin) => [$jenisKelamin => ucwords($jenisKelamin)]))
                    ->searchable(),
                SelectFilter::make('jenis_akun')
                    ->options(Pengguna::where('jenis_akun', '!=', 'admin')
                        ->select('jenis_akun')->distinct()->get()->pluck('jenis_akun')
                        ->mapWithKeys(fn ($jenisAkun) => [$jenisAkun => ucwords($jenisAkun)]))
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
                        TextInput::make('nama_lengkap')
                            ->autofocus()
                            ->required(),
                        Select::make('jenis_kelamin')
                            ->options([
                                'laki-laki' => 'Laki-laki',
                                'perempuan' => 'Perempuan',
                            ])
                            ->searchable()
                            ->required(),
                        TextInput::make('nomor_telepon')
                            ->required(),
                        TextInput::make('email')
                            ->required(),
                        Select::make('jenis_akun')
                            ->searchable()
                            ->options(Pengguna::where('jenis_akun', '!=', 'admin')->select('jenis_akun')
                                ->distinct()->get()->pluck('jenis_akun')
                                ->mapWithKeys(fn ($jenisAkun) => [$jenisAkun => ucwords($jenisAkun)]))
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
            'index' => Pages\ListPenggunas::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PenggunaStats::class,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['transaksi', 'pengaduan']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_lengkap', 'nomor_telepon', 'email'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Jenis Akun' => ucwords($record->jenis_akun),
        ];
    }
}
