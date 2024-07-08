<?php

namespace App\Filament\Resources;

use App\Enums\TopikEnum;
use App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource\Widgets\PengaduanStats;
use App\Models\Pengaduan;
use App\Models\Pengguna;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengaduanResource extends Resource
{
    const NAME = 'Pengaduan';

    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationIcon = 'pengaduan';

    protected static ?string $modelLabel = self::NAME;

    protected static ?string $slug = 'pengaduan';

    protected static ?string $title = self::NAME;

    protected static ?string $navigationLabel = self::NAME;

    protected static ?int $navigationSort = 7;

    public static function getRecordTitle(?Model $record): string | Htmlable | null
    {
        return $record?->getAttribute($record->topik->getLabel()) ?? static::getModelLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Pengaduan')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pengguna')
                    ->label('ID Pengguna')
                    ->description(fn ($record) => $record->pengguna?->nama_lengkap)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengaduan')
                    ->dateTime('d F Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dokumen')
                    ->formatStateUsing(fn ($record) => $record->dokumen ? 'Lihat' : '-')
                    ->color(fn ($record) => $record->dokumen ? 'primary' : 'gray')
                    ->disabledClick(fn ($record) => ! $record->dokumen)
                    ->url(fn ($record) => asset('storage/' . $record->dokumen))
                    ->openUrlInNewTab()
                    ->searchable(),
                Tables\Columns\TextColumn::make('topik')
                    ->badge(),
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
                Filter::make('tanggal_pengaduan')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Tanggal')
                            ->native(false)
                            ->placeholder('Pilih Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pengaduan', '>=', $date)
                            )
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pengaduan', '<=', $date)
                            );
                    }),
                SelectFilter::make('topik')
                    ->options(fn () => DB::table('pengaduan')
                        ->select('topik')
                        ->distinct()
                        ->pluck('topik')
                        ->mapWithKeys(fn ($topik) => [$topik => $topik])
                        ->toArray())
                    ->searchable(),
                SelectFilter::make('id_pengguna')
                    ->options(fn () => Pengguna::where('jenis_akun', '!=', 'admin')
                        ->pluck('nama_lengkap', 'id')->toArray())
                    ->searchable(),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
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
                            ->label('Pengguna')
                            ->options(Pengguna::where('jenis_akun', '!=', 'admin')
                                ->pluck('nama_lengkap', 'id')->mapWithKeys(fn ($namaLengkap, $id) => [$id => $id . ' (' . $namaLengkap . ')']))
                            ->required(),
                        DatePicker::make('tanggal_pengaduan')
                            ->label('Tanggal Pengaduan')
                            ->native(false)
                            ->required(),
                        ToggleButtons::make('topik')
                            ->label('Topik')
                            ->options(TopikEnum::class)
                            ->columnSpanFull()
                            ->required()
                            ->inline(),
                        MarkdownEditor::make('pesan')
                            ->label('Pesan')
                            ->columnSpanFull()
                            ->required(),
                        FileUpload::make('dokumen')
                            ->label('Dokumen')
                            ->columnSpanFull(),
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
            'index' => Pages\ListPengaduans::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PengaduanStats::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['topik'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Pengguna' => $record->pengguna->nama_lengkap,
            'Tanggal Pengaduan' => $record->tanggal_pengaduan,
        ];
    }
}
