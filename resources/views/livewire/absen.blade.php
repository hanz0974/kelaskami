<div>
    <section class="bg-gray-50 dark:bg-gray-900 py-1 sm:py-3">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    {{-- Search --}}
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.300ms="search" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search" required="">
                            </div>
                        </form>
                    </div>
                    @if (Auth()->user()->role == 'dosen')
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" wire:click="buattoken"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 cursor-pointer">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Generate Token
                            </button>
                            <livewire:modal-absen />
                        </div>
                    @else
                        <div x-data="{ showError: @entangle('errorMessage') }" x-init="
                                            $wire.on('clear-error', () => {
                                                setTimeout(() => $wire.set('errorMessage', null), 5000);
                                            })
                                         "
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <form wire:submit.prevent="submitAbsen">
                                <input type="text" wire:model="inputToken"
                                    class="border rounded px-2 py-1 dark:bg-gray-500 dark:placeholder-white"
                                    placeholder="Masukkan token absen">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">
                                    Submit
                                </button>
                            </form>
                        </div>
                        @if($errorMessage)
                            <p class="mt-2.5 text-xs text-fg-danger">{{ $errorMessage }}</p>
                        @endif
                    @endif
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3">No</th>
                                <th scope="col" class="px-2 py-3">Nama Mk</th>
                                <th scope="col" class="px-2 py-3">Kode Mk</th>
                                <th scope="col" class="px-2 py-3">Semester</th>
                                <th scope="col" class="px-2 py-3">Kelas</th>
                                <th scope="col" class="px-2 py-3 flex justify-center">Jadwal</th>
                                <th scope="col" class="px-2 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkul as $mk)
                                <tr wire:key="mk-{{ $mk->kode_mk }}" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="text-center px-1 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-2 py-3">{{ $mk->nama }}</td>
                                    <td class="px-2 py-3">{{ $mk->kode_mk }}</td>
                                    <td class="px-2 py-3">{{ $mk->semester }}</td>
                                    <td class="px-2 py-3">{{ $mk->kelas }}</td>

                                    {{-- Kolom Jadwal --}}
                                    <td class="px-2 py-3">
                                        <div class="flex items-center">
                                            <button id="dropdownMkButton-{{ $mk->kode_mk }}"
                                                data-dropdown-toggle="dropdownMk-{{ $mk->kode_mk }}" type="button"
                                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300
                                                                                   hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg
                                                                                   text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600
                                                                                   dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                <span id="dropdownMkLabel-{{ $mk->kode_mk }}">Pertemuan</span>
                                                <svg class="w-2.5 h-2.5 ms-2.5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg>
                                            </button>

                                            {{-- Dropdown List --}}
                                            <div id="dropdownMk-{{ $mk->kode_mk }}" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm
                                                                                dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownMkButton-{{ $mk->kode_mk }}">
                                                    @forelse($mk->tokenAbsens as $token)
                                                        <li>
                                                            <div
                                                                class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                                                <input id="radio-{{ $mk->kode_mk }}-{{ $loop->index }}"
                                                                    type="radio" value="{{ $token->id }}"
                                                                    wire:model.live="selectedToken.{{ $mk->kode_mk }}"
                                                                    wire:click="$dispatch('close-dropdown', { id: 'dropdownMk-{{ $mk->kode_mk }}' })"
                                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300
                                                                                                                                                          focus:ring-blue-500 dark:focus:ring-blue-600
                                                                                                                                                          dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="radio-{{ $mk->kode_mk }}-{{ $loop->index }}"
                                                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                                    {{ $token->jadwal }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li>
                                                            <div class="p-2 text-gray-500 dark:text-gray-300">Belum ada
                                                                pertemuan</div>
                                                        </li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Actions --}}
                                    <td class="px-2 py-3 flex items-center justify-end">
                                        @if(isset($selectedToken[$mk->kode_mk]))
                                            <a href="{{ route('absen.show', $selectedToken[$mk->kode_mk]) }}" wire:navigate
                                                class="ml-2 text-xs px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Buka Absen
                                            </a>
                                        @else
                                            <span class="text-xs text-gray-400">Pilih jadwal dulu</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (!$search)
                        <x-pagination :items="$matkul" />
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>