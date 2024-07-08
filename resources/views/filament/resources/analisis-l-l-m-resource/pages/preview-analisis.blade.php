<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('Hasil Analisis') }}
        </x-slot>

        <x-slot name="description">
            {{ $record?->model }}
        </x-slot>

        <x-slot name="headerEnd">
            {{ $record->created_at->format('d M Y') }}
        </x-slot>

        @php
        $html = app(Spatie\LaravelMarkdown\MarkdownRenderer::class)->toHtml($record->content);
        @endphp
        {!! nl2br($html) !!}

    </x-filament::section>

    <x-filament::section collapse>
        <x-slot name="heading">
            {{ __('Dataset Analisis') }}
        </x-slot>

        <x-slot name="description">
            {{ $record?->model }}
        </x-slot>

        <x-slot name="headerEnd">
            {{ $record->created_at->format('d M Y') }}
        </x-slot>

        <div class="max-w-4xl mx-auto mt-10 p-4 text-white rounded-lg shadow-lg font-mono"
            style="background-color: #282831">
            {!! str_replace(';', '; </code> <br />', str_replace(':',': <code> <br />', $record->dataset )) !!}
        </div>
    </x-filament::section>

</x-filament-panels::page>