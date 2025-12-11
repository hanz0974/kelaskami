<div id="modal-materi" tabindex="-1" wire:ignore.self
    class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $mode === 'create' ? 'Tambah Materi' : 'Edit Materi' }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                    wire:click.prevent="closeModalMateri">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form wire:submit.prevent="saveMateri">
                @csrf
                <input type="hidden" value="">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="Nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input wire:model="nama" type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nama Materi">
                        @error('nama')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror

                    </div>
                    <div>
                        <label for="Kode Materi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Materi</label>
                        <input wire:model="kode_materi" type="text" name="kode_materi" id="kode_materi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Kode Materi">
                        @error('kode_materi')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kode_mk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            MK</label>
                        <input wire:model="kode_mk" type="text" name="kode_mk" id="kode_mk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="kode_mk">
                        @error('kode_mk')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="file_materi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Materi</label>
                        <input wire:model="file_materi"
                            class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
                            id="file_input" name="file_materi" type="file" accept=".docx, .pdf, .pptx">
                        @if ($existingFileMateri && !$file_materi)
                            <a href="{{ asset('/storage/' . $existingFileMateri) }}" target="_blank"
                                class="mt-2.5 text-xs text-brand"><span class="font-medium">Lihat File Sebelumnya</a>
                        @endif
                                @error('file_materi')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror

                    </div>

                </div>
                <div class="w-full py-2">
                    <label for="deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea wire:model="deskripsi" id="deskripsi" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Deskripsi"></textarea>
                    @error('deskripsi')
                        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    @if ($mode == 'create')
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    @endif
                    {{ $mode === 'create' ? 'Tambah Materi' : 'Edit Materi' }}
                </button>
            </form>
        </div>
    </div>
</div>