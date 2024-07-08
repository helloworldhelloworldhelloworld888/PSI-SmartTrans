<?php

namespace App\Filament\Resources\AnalisisLLMResource\Pages;

use App\Filament\Resources\AnalisisLLMResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;

class PreviewAnalisis extends ViewRecord
{
    protected static string $resource = AnalisisLlmResource::class;

    protected static string $view = 'filament.resources.analisis-l-l-m-resource.pages.preview-analisis';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_START,
            fn (): string => Blade::render('<meta name="robots" content="noindex">'),
        );
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getHeading(): string
    {
        return $this->record->title;
    }

    public function getTitle(): string | Htmlable
    {
        return $this->record->parameters;
    }

    public static function getSlug(): string
    {
        return 'preview-analisis';
    }
}
