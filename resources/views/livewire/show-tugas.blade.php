<div class="max-w-6xl mx-auto py-6">
    <livewire:modal-jawaban-tugas :kode_mk="$kode_mk" />
    <div class="flex">
        <!-- Bagian Konten Tugas -->
        <div
            class="grow-7 size-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow mx-3">

            <h1 class="text-3xl font-semibold mb-1">{{ $tugas->title }}</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                {{ $tugas->dosen->nama }} • {{ $tugas->created_at->format('Y-m-d') }}
            </p>
            <p class="text-gray-800 dark:text-gray-200 leading-relaxed mb-4 break-all whitespace-normal">
                {{ $tugas->deskripsi }}
            </p>
            <div class="border-t pt-4">
                @if ($tugas->file_tugas)
                    <button type="button" wire:click="downloadtugas('{{$tugas->file_tugas}}')"
                        class="my-1 inline-flex items-center justify-center focus:ring-4 focus:ring-brand-medium shadow-xs rounded-base w-9 h-8 focus:outline-none cursor-pointer">
                        <svg class="w-8 h-8 text-success hover:text-success-strong" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
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
                <span class="float-right">Deadline: {{ $tugas->deadline }}</span>
            </div>
        </div>
        <!-- Panel Status Tugas -->
        <div
            class="size-1/2 grow-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow h-1/2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Tugas</h2>
                @if ($jawabantugas)
                    <span class="text-success font-medium">Diserahkan</span>
                @else
                    <span class="text-danger text-center font-medium text-xs">Belum Diserahkan</span>
                @endif
            </div>
            <div class="mb-3">
                @if ($jawabantugas)
                    <div
                        class="w-full h-20 border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center text-gray-500">
                        <a href="{{ asset('/storage/' . $jawabantugas->jawaban_tugas) }}" target="_blank"
                            class="flex justify-center">
                            <img class="w-15 h-15 hover:bg-gray-300 dark:hover:bg-gray-700 hover:rounded-md"
                                src="{{ asset('icon/PDF.png') }}" alt="PDF icon">
                        </a>
                    </div>
                @endif
            </div>
            @if ($jawabantugas)
                @if ($tugas->deadline < now())

                    <button wire:click="delete('{{ $jawabantugas->id }}')"
                        wire:confirm="Anda yakin ingin menghapus jawaban anda?" type="button"
                        class="text-fg-disabled bg-disabled box-border border border-default-medium shadow-xs font-medium leading-5 rounded-base text-sm py-2 w-full focus:outline-none"
                        disabled>
                        Batalkan pengiriman
                    </button>
                @else
                    <button wire:click="$dispatch('upload-tugas', { data: '{{ $tugas->kode_tugas }}' })"
                        class="w-full py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 mb-4">
                        Batalkan pengiriman
                    </button>
                @endif
            @else
                @if ($tugas->deadline < now())
                    <button wire:click="$dispatch('upload-tugas', { data: '{{ $tugas->kode_tugas }}' })"
                        class="text-fg-disabled bg-disabled box-border border border-default-medium shadow-xs font-medium leading-5 rounded-base text-sm py-2 w-full focus:outline-none"
                        disabled>
                        Kirim tugas
                    </button>
                @else
                    <button wire:click="$dispatch('upload-tugas', { data: '{{ $tugas->kode_tugas }}' })"
                        class="w-full py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 mb-4">
                        Kirim tugas
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>