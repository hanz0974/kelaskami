<div>
    {{-- Search bar. --}}
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
    </div>
    <div class="px-1">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
            <tbody>
                @foreach ($jawaban as $jwbn)
                    <tr class="border-b dark:border-gray-700 ">
                        <td scope="row"
                            class="text-center px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                            </svg>
                        </td>
                        <td class="px-6 py-4">{{ $jwbn->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 whitespace-normal break-words max-w-[200px]">{{ $jwbn->deskripsi }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($jwbn->jawaban_tugas)
                                <a href="{{ asset('/storage/' . $jwbn->jawaban_tugas) }}" target="_blank"
                                    class="flex justify-center">
                                    <img class="w-7 h-7 hover:bg-gray-300 dark:hover:bg-gray-700 hover:rounded-md"
                                        src="{{ asset('icon/PDF.png') }}" alt="PDF icon">
                            @else
                                    <p class="text-gray-500 text-sm text-center">Belum ada jwbn</p>
                                @endif
                        </td>
                        <td class="px-6 py-4">{{ $jwbn->status == 'submitted' ? 'Diserahkan' : 'Belum di serahkan' }}</td>
                        <td class="px-6 py-4">
                            <form wire:submit="updatejawaban('{{ $jwbn->nim }}')" class="text-center">
                                @csrf
                                <div class="relative">
                                    <input type="number" wire:model.defer="nilai" value="{{ $jwbn->nilai }}"
                                        class="w-1/4 rounded dark:bg-gray-600">
                                    <button type="submit" class="text-center mx-3">
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
                                </div>
                                @error('nilai')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>