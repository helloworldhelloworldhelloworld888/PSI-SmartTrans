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

    <div class="px-4 pt-6">
        <!-- Active Card -->
        <a href="{{ route('filament.user.pages.qr', now()->timestamp) }}">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4 border border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <x-car-svg />
                    </div>
                    <span class="text-green-500 font-bold">Aktif</span>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="text-gray-600">Kadaluwarsa</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-lg font-semibold">08:00 AM</span>
                        <span class="text-lg font-semibold">00:00 AM</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-gray-400">29 Jun 2024</span>
                        <span class="text-gray-400">30 Jun 2024</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- Sukses Card -->
        <a href="{{ route('filament.user.pages.qr') }}">
            <div class="bg-white shadow-md rounded-lg p-4 mb-4 border border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <x-car-svg />
                    </div>
                    <span class="text-blue-500 font-bold">Sukses</span>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="text-gray-600">Kadaluwarsa</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-lg font-semibold">10:00 AM</span>
                        <span class="text-lg font-semibold">00:00 AM</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-gray-400">28 Jun 2024</span>
                        <span class="text-gray-400">29 Jun 2024</span>
                    </div>
                </div>
            </div>
        </a>
    </div>


</div>
