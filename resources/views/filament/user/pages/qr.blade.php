<div class="min-h-screen w-full bg-slate-100 shadow-md">
    <x-header-user />

    <div class="px-4 pt-6">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Kode QR
        </h2>
        <p class="mt-2 text-md font-medium leading-3 text-gray-600">
            Scan kode QR Anda di Bis
        </p>
        <p class="mt-2 text-sm leading-3 text-gray-600">
            *Saldo akan kembali
            jika kode QR tidak digunakan
        </p>
    </div>

    <div class="px-4 pt-10">
        <div class="flex flex-col items-center justify-center">
            <div class=" h-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" width="254" height="256" viewBox="0 0 254 256" fill="none">
                    <path d="M0 1H56V13.7423H13.5035V58H0V1Z" fill="#FC0000" />
                    <path d="M253 0L253 57L240.481 57L240.481 13.7447L197 13.7447L197 -2.60169e-06L253 0Z"
                        fill="#FC0000" />
                    <path d="M254 255L198 255L198 242.258L240.496 242.258L240.496 198L254 198L254 255Z"
                        fill="#FC0000" />
                    <path d="M1 256L0.999997 199L13.5188 199L13.5188 242.255L57 242.255L57 256L1 256Z" fill="#FC0000" />
                </svg>
                <div class="flex flex-col items-center justify-center -mt-56 w-full h-full">
                    {!! QrCode::size(200)->format('svg')->generate(request()->url()) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="text-center pt-10">
        <p class="leading-6 text-gray-600 py-6">
            Scan kode QR saat <span class="text-red-500 font-semibold">naik</span><br />
            dan <span class="text-red-500 font-semibold">turun</span> transportasi
        </p>
        <x-filament::button wire:click="triggerButton"
            class="w-1/2 bg-green-500 text-white text-lg font-bold py-3 px-8 rounded-full hover:bg-green-600">
            {{ $label }}
        </x-filament::button>
    </div>

</div>
