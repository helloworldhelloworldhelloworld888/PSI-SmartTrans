@props([
'user' => filament()->auth()->user(),
])

<x-filament::avatar :src="filament()->getUserAvatarUrl($user)" :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->class(['fi-user-avatar'])
    ">
    <div class="hidden sm:flex flex-col p-3">
        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->nama_lengkap }}</div>
        <div class="text-sm text-gray-500">Marketing</div>
    </div>
</x-filament::avatar>
