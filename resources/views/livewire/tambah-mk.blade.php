<div> 
    <!-- Main modal -->
    <div id="tambah-mk" tabindex="-1" wire:ignore.self
        class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $mode === 'create' ? 'Tambah Mata Kuliah' : 'Edit Mata Kuliah' }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        wire:click.prevent="resetToCreate">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit="save" class="p-4 md:p-5" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="">
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                Mk</label>
                            <input type="text" id="kode_mk" wire:model="kode_mk"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter title">
                            @error('kode_mk')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" id="nama" wire:model="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter title">
                            @error('nama')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kelas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <input type="text" id="kelas" wire:model="kelas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter title">
                            @error('kelas')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="sks"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">sks</label>
                            <input type="number" id="sks" wire:model="sks" aria-describedby="helper-text-explanation"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="90210" />
                            @error('sks')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="semester"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                            <input type="number" id="semester" wire:model="semester"
                                aria-describedby="helper-text-explanation"
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="90210" />
                            @error('semester')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-center w-full ">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-base cursor-pointer hover:bg-neutral-tertiary-medium ">
                                <div class="flex flex-col items-center justify-center text-body pt-5 pb-6 ">
                                    <svg class="w-8 h-8 mb-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or drag
                                        and drop</p>
                                    <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input wire:model="foto" id="dropzone-file" type="file" class="hidden"
                                    accept=".png, .jpg, .jpeg" />
                                @error('foto') <span class="error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        @if ($existingFoto && !$foto)
                            <img src="{{ asset( $existingFoto) }}" class="w-20 h-20 rounded-base">
                        @endif
                        @if ($foto)
                            <img class="w-20 h-20 rounded-base" src="{{ $foto->temporaryUrl() }} ">
                        @endif
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click.prevent="resetToCreate"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 focus:outline-none">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800 focus:outline-none cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>