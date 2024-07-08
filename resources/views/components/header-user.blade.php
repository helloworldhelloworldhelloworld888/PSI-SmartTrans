<div>
    <div style="background-color: #003273;" class="flex gap-2 justify-between">
        <div class="py-4 px-4 justify-start">
            <a href="{{ route('filament.user.pages.dashboard') }}">
                <x-logo color="#ffffff" />
            </a>
        </div>
        <div class="py-4 px-4 flex gap-3 justify-end">
            <a href="{{ route('filament.user.pages.qr-list') }}">
                <img src="{{ asset('images/barcode-scan.png') }}" alt="logo" class="h-7 w-7">
            </a>
            <a href="{{ route('filament.user.auth.profile') }}">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 13C15.866 13 19 16.134 19 20V22C19 22.5523 19.4477 23 20 23C20.5523 23 21 22.5523 21 22V20C21 15.0294 16.9706 11 12 11C7.02944 11 3 15.0294 3 20V22C3 22.5523 3.44772 23 4 23C4.55228 23 5 22.5523 5 22V20C5 16.134 8.13401 13 12 13Z"
                        fill="#777E91" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7C16 9.20914 14.2091 11 12 11ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13Z"
                        fill="#777E91" />
                </svg>
            </a>
        </div>
    </div>
    <div style="background-color: #e6e6e6">
        <div class="py-4 px-8 flex gap-2 justify-between">
            <a href="{{ route('filament.user.pages.dashboard') }}" class="flex flex-col items-center space-y-2">
                <img src="{{ asset('images/home.png') }}" alt="logo" class="h-8 w-8">
                <small class="text-xs leading-3 text-gray-900">Beranda</small>
            </a>
            <a href="{{ route('filament.user.pages.rute') }}" class="flex flex-col items-center space-y-2">
                <img src="{{ asset('images/deadline.png') }}" alt="logo" class="h-8 w-8">
                <small class="text-xs leading-3 text-gray-900">Rute & Jadwal</small>
            </a>
            <a href="{{ route('filament.user.pages.pengaduan') }}" class="flex flex-col items-center space-y-2">
                <img src="{{ asset('images/feedback.png') }}" alt="logo" class="h-8 w-8">
                <small class="text-xs leading-3 text-gray-900">Pengaduan</small>
            </a>
        </div>
    </div>
</div>
