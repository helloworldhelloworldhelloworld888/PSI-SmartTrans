<div class="min-h-screen w-full bg-slate-100 shadow-md">
    <x-header-user />

    <div class="px-4 pt-6 text-center">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Profil
        </h2>
    </div>

    <div class="px-4 pt-6 py-4">
        <p class="text-lg text-gray-800 pb-6">Informasi akun</p>

        <x-filament-panels::form wire:submit="save">
            {{ $this->form }}

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>
        <div class="text-center pt-10">
            <form method="POST" action="{{ route('filament.user.auth.logout') }}">
                @csrf

                <x-filament::button onclick="event.preventDefault(); this.closest('form').submit();" color="danger"
                    class="w-full bg-red-500 text-white text-lg font-bold px-8 rounded-full hover:bg-red-600">
                    Logout
                </x-filament::button>
            </form>
        </div>

    </div>

</div>