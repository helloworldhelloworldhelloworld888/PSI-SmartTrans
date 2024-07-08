<div class="min-h-screen w-full bg-slate-100">
    <div style="background-color: #003273;">
        <div class="p-7 py-10">
            <h2 class="text-4xl leading-8 text-white tracking-tight">Smart
                <span class="font-bold text-4xl">Trans</span>
            </h2>
            <p class="mt-2 text-xs leading-6 text-white">
                Pilihan Terbaik untuk <br />
                Perjalanan Sehari-hari
            </p>
        </div>
    </div>
    <div class="p-7">
        <x-filament-panels::form wire:submit="authenticate">
            <div>
                <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Selamat Datang Kembali!</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Masuk untuk mengakses akun SmartTrans Anda
                </p>
            </div>

            {{ $this->form }}
            <div class="-mt-6 text-end">
                <x-filament::link :href="filament()->getRequestPasswordResetUrl()"> {{
                    __('filament-panels::pages/auth/login.actions.request_password_reset.label') }}
                </x-filament::link>
            </div>

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>

        <div class="mt-10">
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm font-medium leading-6">
                    <span class="px-6 text-gray-900">Or continue with</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-4 px-14">
                <a href="#"
                    class="flex w-full items-center justify-center gap-3 rounded-md bg-slate-100 px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-300 border border-1">
                    <svg class="h-5 w-5" viewBox="0 0 25 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24.5 12.0733C24.5 5.40546 19.1274 0 12.5 0C5.87262 0 0.5 5.40536 0.5 12.0733C0.5 18.0994 4.88825 23.0943 10.625 24V15.5633H7.57812V12.0733H10.625V9.41343C10.625 6.38755 12.4166 4.71615 15.1575 4.71615C16.4705 4.71615 17.8438 4.95195 17.8438 4.95195V7.92313H16.3306C14.8398 7.92313 14.375 8.85381 14.375 9.80864V12.0733H17.7031L17.1711 15.5633H14.375V24C20.1117 23.0943 24.5 18.0995 24.5 12.0733Z"
                            fill="#1877F2" />
                    </svg>
                </a>
                <a href="#"
                    class="flex w-full items-center justify-center gap-3 rounded-md bg-slate-100 shadow-sm outline-slate-500 border border-1 max px-3 py-1.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                    <svg class=" h-5 w-5" fill="currentColor" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.3055 10.0415H21.5V10H12.5V14H18.1515C17.327 16.3285 15.1115 18 12.5 18C9.1865 18 6.5 15.3135 6.5 12C6.5 8.6865 9.1865 6 12.5 6C14.0295 6 15.421 6.577 16.4805 7.5195L19.309 4.691C17.523 3.0265 15.134 2 12.5 2C6.9775 2 2.5 6.4775 2.5 12C2.5 17.5225 6.9775 22 12.5 22C18.0225 22 22.5 17.5225 22.5 12C22.5 11.3295 22.431 10.675 22.3055 10.0415Z"
                            fill="#FFC107" />
                        <path
                            d="M3.653 7.3455L6.9385 9.755C7.8275 7.554 9.9805 6 12.5 6C14.0295 6 15.421 6.577 16.4805 7.5195L19.309 4.691C17.523 3.0265 15.134 2 12.5 2C8.659 2 5.328 4.1685 3.653 7.3455Z"
                            fill="#FF3D00" />
                        <path
                            d="M12.5 21.9999C15.083 21.9999 17.43 21.0114 19.2045 19.4039L16.1095 16.7849C15.0718 17.574 13.8037 18.0009 12.5 17.9999C9.899 17.9999 7.6905 16.3414 6.8585 14.0269L3.5975 16.5394C5.2525 19.7779 8.6135 21.9999 12.5 21.9999Z"
                            fill="#4CAF50" />
                        <path
                            d="M22.3055 10.0415H21.5V10H12.5V14H18.1515C17.7571 15.1082 17.0467 16.0766 16.108 16.7855L16.1095 16.7845L19.2045 19.4035C18.9855 19.6025 22.5 17 22.5 12C22.5 11.3295 22.431 10.675 22.3055 10.0415Z"
                            fill="#1976D2" />
                    </svg>
                </a>
                <a href="#"
                    class="flex w-full items-center justify-center gap-3 rounded-md bg-slate-100 px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-100 border border-1">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.0172 12.5555C18.0078 10.957 18.732 9.75234 20.1945 8.86406C19.3766 7.69219 18.1391 7.04766 16.5078 6.92344C14.9633 6.80156 13.2734 7.82344 12.6547 7.82344C12.0008 7.82344 10.5055 6.96563 9.32891 6.96563C6.90078 7.00313 4.32031 8.90156 4.32031 12.7641C4.32031 13.9055 4.52891 15.0844 4.94609 16.2984C5.50391 17.8969 7.51484 21.8133 9.6125 21.75C10.7094 21.7242 11.4852 20.9719 12.9125 20.9719C14.2977 20.9719 15.0148 21.75 16.2383 21.75C18.3547 21.7195 20.1734 18.1594 20.7031 16.5563C17.8648 15.218 18.0172 12.6375 18.0172 12.5555ZM15.5539 5.40703C16.7422 3.99609 16.6344 2.71172 16.5992 2.25C15.5492 2.31094 14.3352 2.96484 13.6437 3.76875C12.882 4.63125 12.4344 5.69766 12.5305 6.9C13.6648 6.98672 14.7008 6.40313 15.5539 5.40703Z"
                            fill="#313131" />
                    </svg>
                </a>
            </div>
            <div class="text-center mt-2">
                <a href="{{ filament()->getRegistrationUrl() }}" class="text-sm font-medium">
                    Belum punya akun? <span style="color: #FF8682">Daftar</span>
                </a>
            </div>
        </div>
    </div>
</div>
