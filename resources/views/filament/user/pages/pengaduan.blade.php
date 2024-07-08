<div class="min-h-screen w-full bg-slate-100 shadow-md">
    <x-header-user />

    <div class="px-7 pt-6">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">
            Apa yang Anda keluhkan?
        </h2>
        <p class="mt-2 text-sm leading-3 text-gray-600">
            Kenyamanan Anda adalah misi utama kami
        </p>
    </div>

    <div class="px-7 pt-6">
        @foreach ($topiks as $topik)
        <div class="pt-4">
            <x-filament::button class="w-full py-3" color="gray"
                href="{{ route('filament.user.pages.form-pengaduan', ['topik'=>$topik->value]) }}" tag="a">
                {{ ucwords($topik->getLabel()) }}
            </x-filament::button>
        </div>
        @endforeach
    </div>

</div>
