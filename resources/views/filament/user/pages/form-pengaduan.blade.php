<div class="min-h-screen w-full bg-slate-100 shadow-md">
    <x-header-user />

    <div class="px-4 pt-6">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Tuliskan keluhan Anda
        </h2>
        <p class="mt-2 text-sm leading-3 text-gray-600">
            Kami akan berusaha untuk memberikan solusi terbaik
        </p>
    </div>

    <div class="px-4 py-6">
        <x-filament-panels::form>
            {{ $this->form }}

            <x-filament::button wire:click="create">
                KIRIM
            </x-filament::button>
        </x-filament-panels::form>
    </div>


</div>
