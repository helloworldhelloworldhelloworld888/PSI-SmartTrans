<div class="w-full bg-slate-100 shadow-md h-full min-h-screen">
    <x-header-user />

    <div class="px-6 pt-6 ">
        <h2 class="text-2xl font-bold leading-8 text-gray-800 tracking-tight">Hai, {{ auth()->user()->nama_lengkap }}
        </h2>
        <p class="mt-2 text-sm leading-3 text-gray-600">
            Mau kemana hari ini?
        </p>
    </div>
    <div class="flex justify-center items-center min-w-screen">
        <div class="lg:max-w-screen-sm w-full">
            <div class="py-5 px-7">
                <x-card />
            </div>

            <div class="flex flex-col items-center gap-4 py-2">
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <button class="flex items-center justify-center w-16 h-16 rounded-full focus:outline-none"
                            style="background-color: #1E1671">
                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.75 9.5C13.3358 9.5 13 9.83579 13 10.25C13 10.6642 13.3358 11 13.75 11H16.25C16.6642 11 17 10.6642 17 10.25C17 9.83579 16.6642 9.5 16.25 9.5H13.75ZM2.75 0C1.23122 0 0 1.23122 0 2.75V11.25C0 12.7688 1.23122 14 2.75 14H17.25C18.7688 14 20 12.7688 20 11.25V2.75C20 1.23122 18.7688 0 17.25 0H2.75ZM1.5 11.25V6H18.5V11.25C18.5 11.9404 17.9404 12.5 17.25 12.5H2.75C2.05964 12.5 1.5 11.9404 1.5 11.25ZM1.5 4.5V2.75C1.5 2.05964 2.05964 1.5 2.75 1.5H17.25C17.9404 1.5 18.5 2.05964 18.5 2.75V4.5H1.5Z"
                                    fill="white" />
                            </svg>
                        </button>
                        <span class="mt-2 text-center font-medium text-xs text-gray-700">Isi Saldo</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <a href="{{ route('filament.user.pages.pin-code') }}"
                            class="flex items-center justify-center w-16 h-16 rounded-full focus:outline-none"
                            style="background-color: #1573FF">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_295_5681)">
                                    <path
                                        d="M10.0052 0.909088C5.05893 0.909088 1.05261 1.39272 1.05261 4.77545V14.44C1.0536 14.8455 1.15379 15.2463 1.34662 15.616C1.53945 15.9857 1.82057 16.3161 2.17156 16.5855V18.3055C2.17212 18.5617 2.29015 18.8073 2.49984 18.9885C2.70953 19.1698 2.99381 19.272 3.29051 19.2727H4.41051C4.70727 19.2727 4.99188 19.1709 5.20172 18.9897C5.41157 18.8085 5.52945 18.5626 5.52945 18.3064V17.34H14.4821V18.3064C14.4821 18.5626 14.6 18.8085 14.8098 18.9897C15.0197 19.1709 15.3043 19.2727 15.601 19.2727H16.72C17.0165 19.272 17.3006 19.17 17.5103 18.9889C17.72 18.8078 17.8381 18.5625 17.8389 18.3064V16.5864C18.1899 16.317 18.471 15.9866 18.6639 15.6169C18.8567 15.2472 18.9569 14.8465 18.9579 14.4409V4.77545C18.9589 1.39272 14.9474 0.909088 10.0052 0.909088ZM4.96946 15.4073C4.63739 15.4073 4.31278 15.3223 4.03669 15.1629C3.76058 15.0035 3.54539 14.7771 3.41831 14.5122C3.29123 14.2472 3.25798 13.9556 3.32277 13.6744C3.38755 13.3931 3.54745 13.1347 3.78227 12.932C4.01707 12.7292 4.31622 12.5911 4.64191 12.5351C4.96759 12.4792 5.30517 12.5079 5.61196 12.6176C5.91875 12.7274 6.18096 12.9133 6.36546 13.1517C6.54994 13.3902 6.6484 13.6705 6.6484 13.9573C6.64869 14.1477 6.60544 14.3365 6.52117 14.5125C6.43689 14.6885 6.31322 14.8485 6.15727 14.9831C6.00131 15.1178 5.81611 15.2246 5.61229 15.2974C5.40847 15.3702 5.19001 15.4075 4.96946 15.4073ZM15.0421 15.4073C14.71 15.4073 14.3855 15.3223 14.1094 15.1629C13.8332 15.0035 13.618 14.7771 13.4909 14.5122C13.3639 14.2472 13.3306 13.9556 13.3954 13.6744C13.4602 13.3931 13.6201 13.1347 13.8549 12.932C14.0897 12.7292 14.3888 12.5911 14.7145 12.5351C15.0402 12.4792 15.3778 12.5079 15.6846 12.6176C15.9914 12.7274 16.2536 12.9133 16.4381 13.1517C16.6226 13.3902 16.721 13.6705 16.721 13.9573C16.7214 14.1477 16.6781 14.3365 16.5938 14.5125C16.5096 14.6885 16.3859 14.8485 16.2299 14.9831C16.074 15.1178 15.8887 15.2246 15.6849 15.2974C15.4811 15.3702 15.2626 15.4075 15.0421 15.4073ZM16.721 9.60818H3.29051V4.77545H16.72L16.721 9.60818Z"
                                        stroke="#EEEEEE" stroke-width="1.5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_295_5681">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <span class="mt-2 text-center font-medium text-xs text-gray-700">Naik Bis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-7 pt-4 py-6">
        <h2 class="text-md font-bold leading-8 text-black-400 tracking-tight">
            Perjalanan Anda saat ini
        </h2>
        <ul class="space-y-6 pt-3">
            <li class="relative flex gap-x-4">
                <div class="absolute inset-y-0 left-3 flex items-center justify-center">
                    <div class="w-px h-full bg-gray-200"></div>
                </div>
                <div class="relative flex h-6 w-6 flex-none items-center justify-center z-10">
                    <div class="h-2 w-2 rounded-full bg-red-600"></div>
                </div>
                <p class="flex-auto py-0.5 font-bold text-xs leading-5 text-gray-600">
                    {{ $dataRute->rute->halteAwal->nama_halte ?: '-' }}
                </p>
            </li>
            @if ($dataRute->rute->halteAkhir)
            <li class="relative flex gap-x-4">
                <div class="absolute inset-y-0 left-3 flex items-center justify-center">
                    <div class="w-px h-full bg-gray-200"></div>
                </div>
                <div class="relative flex h-6 w-6 flex-none items-center justify-center z-10">
                    <div class="h-2 w-2 rounded-full bg-red-600"></div>
                </div>
                <p class="flex-auto py-0.5 font-bold text-xs leading-5 text-gray-600">
                    {{ $dataRute->rute->halteAkhir->nama_halte ?: '-' }}
                </p>
            </li>
            @endif
            @php
            use App\Models\Halte;
            @endphp
            @for ($i = 1; $i <= 5; $i++) @if (isset($dataRute->rute->{"id_halte_$i"}) &&
                Halte::find($dataRute->rute->{"id_halte_$i"}) != null)
                <li class="relative flex gap-x-4">
                    <div class="absolute inset-y-0 left-3 flex items-center justify-center">
                        <div class="w-px h-full bg-gray-200"></div>
                    </div>
                    <div class="relative flex h-6 w-6 flex-none items-center justify-center z-10">
                        <div class="h-2 w-2 rounded-full bg-green-600"></div>
                    </div>
                    <p class="flex-auto py-0.5 font-bold text-xs leading-5 text-gray-600">
                        {{ Halte::find($dataRute->rute->{"id_halte_$i"})?->nama_halte ?: '-' }}
                    </p>
                </li>
                @endif
                @endfor
        </ul>
    </div>
</div>
