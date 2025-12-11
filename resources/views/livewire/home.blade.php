<div class="antialiased bg-gray-50 dark:bg-gray-900">
    <div class="relative w-full py-4">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="search" wire:model.live.debounce.300ms="search"
            class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
            placeholder="Search" required />
    </div>
    @if (auth()->user()->role == 'dosen')
        <section class="grid grid-cols-1 pb-4 items-center bg-gray-50 dark:bg-gray-900">
            <div class="w-full max-w-7xl mx-auto lg:px-3">
                <!-- Start coding here -->
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold dark:text-white">Selamat datang {{auth()->user()->name }}</h5>
                        </div>
                        <div>
                            <button wire:click="tambahMk"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 cursor-pointer">
                                <svg class="h-3.5 w-3.5 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                Tambah Matakuliah
                            </button>
                            <livewire:tambah-mk />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <ul class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        @foreach ($matkul as $mk)
            <li wire:key="{{ $mk->kode_mk }}">
                <div
                    class="bg-neutral-primary-soft block max-w-sm border border-gray-300 dark:border-gray-700 rounded-base shadow-xs hover:shadow-xl/10 dark:hover:shadow-gray-400 dark:hover:shadow-xl/10">
                    <a href="{{ route('class.index', ['kode_mk' => $mk->kode_mk]) }}" wire:navigate>
                        <img class="w-full rounded-t-base" src="{{ asset($mk->foto) }}" alt="" />
                    </a>

                    <div class="p-6 text-center">
                        <span
                            class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">
                            Semester: {{ $mk->semester }}
                        </span>
                        <a href="{{ route('class.index', ['kode_mk' => $mk->kode_mk]) }}" wire:navigate>
                            <h5
                                class="mt-3 mb-6 text-2xl font-semibold tracking-tight text-heading truncate max-w-[10ch] sm:max-w-[15ch] lg:max-w-[25ch]">
                                {{  $mk->nama }}
                            </h5>
                        </a>
                    </div>
                    <p class="border-t border-gray-300  dark:border-gray-700"></p>
                    <div class="w-full py-3 flex justify-center items-center">
                        @if (Auth()->user()->role == 'dosen')
                            <div class="grid grid-cols-2 sm:grid-cols-1 lg:grid-cols-2 gap-3">
                                <button wire:click="show('{{ $mk->kode_mk }}')" type="button"
                                    class="items-center text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none text-center cursor-pointer">
                                    Edit
                                </button>
                                <button wire:click="delete('{{ $mk->kode_mk }}')"
                                    wire:confirm="Anda yakin ingin menghapus Matakuliah {{ $mk->nama }}?" type="button"
                                    class="items-center text-white bg-danger box-border border border-transparent hover:bg-danger-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none text-center cursor-pointer">Hapus</button>
                            </div>
                        @else
                            <a href="{{ route('class.index', ['kode_mk' => $mk->kode_mk]) }}" wire:navigate
                                class="inline-flex items-center text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                Read more
                                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </a>
                        @endif
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</div>