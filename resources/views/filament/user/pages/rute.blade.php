<div class="min-h-screen w-full bg-slate-100 shadow-md">
    <x-header-user />
    @php
    use App\Models\Halte;
    @endphp
    <div class="px-7 pt-6">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Rute dan Jadwal
        </h2>
        <p class="mt-2 text-sm leading-3 text-gray-600">
            Cek rute dan jadwal keberangkatan
        </p>
    </div>
    <div class="px-7 py-6 flex justify-center items-center min-w-screen">
        <div class="lg:max-w-screen-sm w-full">
            <img src="{{ asset('images/rutebus.png') }}" alt="Rute dan Jadwal" class="w-full">
        </div>
    </div>

    <div class="px-7">
        <x-filament::input.wrapper :valid="! $errors->has('ruteChoice')">
            <x-filament::input.select class="py-3" wire:model="ruteChoice">
                <option value="">Pilih Lokasi Awal dan Tujuan</option>
                @foreach ($dataRute as $rute)
                <option value="{{ $rute->id }}">{{ $rute->nama_rute }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>
        <span class="text-red-500 text-sm">{{ $errors->first('ruteChoice') }}</span>
    </div>

    <div class="text-center pt-8">
        <x-filament::button wire:click="cariRute" class=" text-white text-lg font-bold py-3 px-8 rounded-full">
            Lihat Rute & Jadwal
        </x-filament::button>
    </div>

    @if ($ruteChoice)

    <div class="px-7 py-6 ">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Rute
        </h2>

        <ul class="space-y-6 pt-3 ">
            @for ($i = 1; $i <= 5; $i++) @if (isset($data->rute->{"id_halte_$i"}) &&
                Halte::find($data->rute->{"id_halte_$i"}) != null)
                <li class="relative flex gap-x-4">
                    <div class="absolute left-0 top-0 flex w-6 justify-center -bottom-6">
                        <div class="w-px bg-gray-200"></div>
                    </div>
                    <div class="relative flex h-6 w-6 flex-none items-center justify-center">
                        <div class="h-2 w-2 rounded-full bg-green-600"></div>
                    </div>
                    <p class="flex-auto py-0.5 font-bold text-xs leading-5 text-gray-600">
                        Halte {{ Halte::find($data->rute->{"id_halte_$i"})?->nama_halte ?: '-' }}
                    </p>
                </li>
                @endif
                @endfor
        </ul>
    </div>
    <div class="px-7 py-6 ">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Jadwal Keberangkatan
        </h2>
        <p class="pt-3">Bis tersedia:
            <x-filament::button size="sm" style="background-color: #9500DB" class="px-3">
                {{ $data->kode_bis }}
            </x-filament::button>
        </p>
        <div class="grid grid-cols-3 gap-2 pt-3">
            @for ($i = 1; $i <= 4; $i++) <x-filament::button size="sm" color="gray">
                {{ date('H:i', strtotime($data->jadwal->{"jam_keberangkatan_$i"})) }}
                </x-filament::button>
                @endfor
        </div>
    </div>
    @endif
</div>
