<div>
    <livewire:kelas :kode_mk="$kode_mk" />
    <section class="bg-white dark:bg-gray-900 py-1 sm:py-3">
        <div class="mx-auto max-w-screen-xl ">
            <!-- Search bar -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
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
                            <button type="button" wire:click="tambahtugas"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 cursor-pointer">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Tambah tugas
                            </button>
                            <livewire:modal-tugas />
                            @if($tugas->isNotEmpty())
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                        type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Actions
                                    </button>
                                    <div id="actionsDropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <div>
                                            <button wire:click="deleteAll"
                                                wire:confirm="Anda yakin ingin menghapus semua tugas?"
                                                class="block py-2 w-full text-sm text-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                                all</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <livewire:modal-jawaban-tugas :kode_mk="$kode_mk" />
                    @endif
                </div>
            </div>
            <div class="py-2 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-6">
                <div class="grid gap-8">
                    @foreach ($tugas as $tugass)
                        <div
                            class="flex bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-200 dark:bg-gray-800 hover:dark:bg-gray-700 dark:border-gray-700 cursor-pointer ">
                            <div class="p-3 grow "
                                href="{{ Auth()->user()->role == 'mahasiswa' ? route('class.show', ['kode_mk' => $kode_mk, 'kode_tugas' => $tugass->kode_tugas]) : route('class.jawaban', ['kode_mk' => $kode_mk, 'kode_tugas' => $tugass->kode_tugas]) }}"
                                wire:navigate>
                                <div class="flex justify-between items-center mb-2 text-gray-500">
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                        {{ $tugass->kode_tugas }}
                                    </span>
                                    <span class="text-sm">{{ $tugass->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="grow flex items-center text-center">

                                    <svg class="w-10 h-10 px-1.5 dark:text-gray-800 text-white mx-2 rounded-lg bg-gray-500 dark:bg-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4" />
                                    </svg>
                                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $tugass->dosen->nama }} memposting tugas baru:
                                        {{ $tugass->title }}
                                    </h2>

                                </div>
                            </div>
                            @if (Auth()->user()->role == 'dosen')
                                <div class="flex items-center justify-center mx-2 mt-2">
                                    <button class="mx-1 cursor-pointer" type="button"
                                        wire:click="edittugas('{{$tugass->kode_tugas}}')" onclick="event.stopPropagation();">
                                        <svg class="w-6 h-6 text-brand hover:text-brand-strong" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button class="mx-1 cursor-pointer" type="button"
                                        wire:click="deletetugas('{{$tugass->kode_tugas}}')"
                                        wire:confirm="Anda yakin ingin menghapus tugas {{ $tugass->title }}?">
                                        <svg class="w-6 h-6 text-danger hover:text-danger-strong" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>

                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
{{-- <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="flex justify-center px-1 py-3">No</th>
                <th scope="col" class="px-1 py-3">Kode</th>
                <th scope="col" class="py-3">Title</th>
                <th scope="col" class="py-3">Deskripsi</th>
                <th scope="col" class="py-3 pl-3">Deadline</th>
                <th scope="col" class="py-3 text-center">File</th>
                <th scope="col" class="py-3 text-center">File Jawaban</th>
                <th scope="col" class="py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tugas as $tugass)
            <tr wire:key="tugas-{{ $tugass->kode_tugas }}" class="border-b dark:border-gray-700">
                <th scope="row"
                    class="text-center px-1 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->index + $tugas->firstItem()}}
                </th>
                <td class="py-3">{{ $tugass->kode_tugas }}</td>
                <td class="py-3">{{ $tugass->title }}</td>
                <td class="py-3 whitespace-normal break-words max-w-[200px]">{{ $tugass->deskripsi }}
                </td>
                <td class="py-3 pl-3">{{ $tugass->deadline }}</td>
                <td class="py-3">
                    @if ($tugass->file_tugas)
                    <a href="{{ asset('/storage/' . $tugass->file_tugas) }}" target="_blank"
                        class="flex justify-center">
                        <img class="w-7 h-7 hover:bg-gray-300 dark:hover:bg-gray-700 hover:rounded-md"
                            src="{{ asset('icon/PDF.png') }}" alt="PDF icon">
                        @endif
                </td>
                <td class="py-3">
                    @forelse ($tugass->jawaban as $jawaban)
                    <a href="{{ asset('/storage/' . $jawaban->jawaban_tugas) }}" target="_blank"
                        class="flex justify-center">
                        <img class="w-7 h-7 hover:bg-gray-300 dark:hover:bg-gray-700 hover:rounded-md"
                            src="{{ asset('icon/PDF.png') }}" alt="PDF icon">
                        @empty
                        <p class="text-gray-500 text-sm text-center">Belum ada jawaban</p>
                        @endforelse
                </td>
                <td class="py-3 px-1 text-center">
                    <div>
                        @if (Auth()->user()->role == 'dosen')
                        <button type="button" wire:click="edittugas('{{$tugass->kode_tugas}}')"
                            class="mx-1 my-1 inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-7 h-7 focus:outline-none cursor-pointer">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                            <span class="sr-only">Edit</span>
                        </button>
                        <button type="button" wire:click="deletetugas('{{$tugass->kode_tugas}}')"
                            wire:confirm="Anda yakin ingin menghapus tugas {{ $tugass->title }}?"
                            class="my-1 inline-flex items-center justify-center  text-white bg-danger hover:bg-danger-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-7 h-7 focus:outline-none cursor-pointer">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>

                            <span class="sr-only">Hapus</span>
                        </button>
                        @elseif (Auth()->user()->role == 'mahasiswa')
                        @if ($tugass->file_tugas)
                        <button type="button" wire:click="downloadtugas('{{$tugass->file_tugas}}')"
                            class="my-1 inline-flex items-center justify-center  text-white bg-success hover:bg-success-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-7 h-7 focus:outline-none cursor-pointer">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Download</span>
                        </button>
                        @endif
                        <button type="button"
                            wire:click="$dispatch('upload-tugas', { data: '{{ $tugass->kode_tugas }}' })"
                            class="my-1 inline-flex items-center justify-center  text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-7 h-7 focus:outline-none cursor-pointer">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Upload</span>
                        </button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (!$search)
    <x-pagination :items="$tugas" />
    @endif
</div> --}}