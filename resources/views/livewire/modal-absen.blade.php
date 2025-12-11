<div id="modal-token" tabindex="-1" wire:ignore.self
    class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Generate Token Absen
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                    wire:click.prevent="closeModaltoken">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form wire:submit="save">
                @csrf
                <input type="hidden" value="">
                <div class="grid mb-4 gap-4 sm:grid-cols-1">
                    <div>
                        <label class="block mt-2">Matakuliah</label>
                        <select wire:model="kode_mk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">-- Pilih Matakuliah --</option>
                            @foreach($matakuliah as $mk)
                                <option class="dark:text-white" value="{{ $mk->kode_mk }}">{{ $mk->nama }}</option>
                            @endforeach
                        </select>
                        @error('kode_mk')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <!-- Dropdown jadwal -->
                        <label class="block mt-4 mb-2 text-sm font-medium">Jadwal</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            type="text" wire:model="jadwal" readonly>
                        @error('jadwal')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <label class="block mt-4 mb-2 text-sm font-medium">Token</label>
                    <div class="flex space-x-2">
                        <input type="text" wire:model="token" id="token" name="token"
                            class="grow p-2 text-sm text-gray-900 bg-gray-50 rounded-l-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            readonly>
                        <button type="button" wire:click="buatToken"
                            class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                            Generate
                        </button>
                        @error('token')
                            <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                        @enderror
                    </div>
                    <label class="block mt-4 mb-2 text-sm font-medium">Valid Until</label>
                    <input type="datetime-local" wire:model="valid_until"
                        class="w-full border rounded px-2 py-1 text-sm dark:bg-gray-800 dark:text-white">
                    @error('valid_until')
                        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">

                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Generate Token
                </button>
            </form>
        </div>
    </div>
</div>