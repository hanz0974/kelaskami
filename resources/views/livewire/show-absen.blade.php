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
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3">No</th>
                                <th scope="col" class="px-2 py-3">Nama</th>
                                <th scope="col" class="px-2 py-3">Nim</th>
                                <th scope="col" class="px-2 py-3">Semester</th>
                                <th scope="col" class="px-2 py-3">Status</th>
                                <th scope="col" class="px-2 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absens as $absen)
                                <tr wire:key="absen-{{ $absen->kode_absen }}" class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="text-center px-1 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-2 py-3">{{ $absen->mahasiswa->nama }}</td>
                                    <td class="px-2 py-3">{{ $absen->nim }}</td>
                                    <td class="px-2 py-3">
                                        {{ ((now()->year - $absen->mahasiswa->angkatan) * 2) + (now()->month >= 7 ? 1 : 0) }}
                                    </td>
                                    <td class="px-2 py-3">{{ $absen->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (!$search)
                        <x-pagination :items="$absens" />
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>