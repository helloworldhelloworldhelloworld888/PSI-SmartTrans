<div class="min-h-screen bg-white">
    <div class="w-full h-full" x-data="{
        pin: '',
        maxLength: 6,
        addPin(number) {
            if (this.pin.length < this.maxLength) {
                this.pin += number.toString();
                if (this.pin.length === this.maxLength) {
                    Livewire.dispatch('pinCompleted', [this.pin]);
                }
            }
        },
        removePin() {
            this.pin = this.pin.slice(0, -1);
        }
    }">
        <x-header-user />
        <div class="flex items-center justify-center py-6">
            <div class="text-center px-4 md:px-8">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Masukan PIN Anda</h1>
                <p class="text-gray-500 mb-6">Harap masukkan PIN transaksi Anda untuk melanjutkan</p>

                <div class="flex justify-center space-x-2 pt-6">
                    <template x-for="n in maxLength" :key="n">
                        <div :class="{'bg-gray-700': pin.length >= n, 'bg-gray-300': pin.length < n}"
                            class="h-4 w-4 rounded-full"></div>
                    </template>
                </div>
                @error('pin')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex items justify-center py-6 mb-6">
            <div class="grid grid-cols-3 gap-4 md:gap-6 ">
                <!-- Number Keys -->
                <template x-for="number in [...Array(9).keys()].map(i => i + 1)" :key="number" class="text-center">
                    <button @click="addPin(number)"
                        class="w-16 h-16 md:w-20 md:h-20 text-xl md:text-2xl font-bold text-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span x-text="number"></span>
                    </button>
                </template>
                <!-- Empty Space -->
                <div class="w-16 h-16 md:w-20 md:h-20"></div>
                <!-- Zero Key -->
                <button @click="addPin(0)"
                    class="w-16 h-16 md:w-20 md:h-20 text-xl md:text-2xl font-bold text-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    0
                </button>
                <!-- Backspace Key -->
                <button @click="removePin()"
                    class="w-16 h-16 md:w-20 md:h-20 text-xl md:text-2xl font-bold rounded-lg flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg width="24" height="24" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M26.75 12.1666C26.75 10.281 26.75 9.3382 26.1642 8.75241C25.5784 8.16663 24.6356 8.16663 22.75 8.16663H11.3907C10.3428 8.16663 9.81884 8.16663 9.37665 8.40328C8.93447 8.63993 8.64382 9.07589 8.06253 9.94783L5.7292 13.4478C5.0122 14.5233 4.6537 15.0611 4.6537 15.6666C4.6537 16.2722 5.0122 16.8099 5.7292 17.8854L8.06253 21.3854C8.64382 22.2574 8.93447 22.6933 9.37665 22.93C9.81884 23.1666 10.3428 23.1666 11.3907 23.1666H22.75C24.6356 23.1666 25.5784 23.1666 26.1642 22.5808C26.75 21.9951 26.75 21.0522 26.75 19.1666V12.1666Z"
                            stroke="#171717" stroke-width="1.5" />
                        <path d="M19.25 13.1666L14.25 18.1666" stroke="#171717" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.25 13.1666L19.25 18.1666" stroke="#171717" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
