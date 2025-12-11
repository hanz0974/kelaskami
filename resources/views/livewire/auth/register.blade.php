<div>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-2 sm:p-4">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>

                    <form wire:submit="register">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama</label>
                                <input type="text" wire:model="name" id="name"
                                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                    placeholder="John" />
                                @error('name')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="nim" class="block mb-2.5 text-sm font-medium text-heading">Nim</label>
                                <input type="text" id="nim" wire:model="nim"
                                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                    placeholder="12345678" />
                                @error('nim')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="angkatan"
                                    class="block mb-2.5 text-sm font-medium text-heading">Angkatan</label>
                                <input type="text" id="angkatan" wire:model="angkatan"
                                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                    placeholder="20.." />
                                @error('angkatan')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="prodi"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Prodi</label>
                                <select wire:model="prodi" id="prodi" name="prodi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select prodi</option>
                                    <option value="S1-Teknik Elektro">S1-Teknik Elektro</option>
                                    <option value="S1-Teknik Komputer">S1-Teknik Komputer</option>
                                </select>
                                @error('prodi')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="jenisKelamin"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                    Kelamin</label>
                                <select wire:model="jenisKelamin" id="jenisKelamin" name="jenisKelamin"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select role</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenisKelamin')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="role"
                                    class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select wire:model="role" id="role" name="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select role</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="dosen">Dosen</option>
                                </select>
                                @error('role')
                                    <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email
                                address</label>
                            <input type="email" wire:model="email"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="john.doe@company.com" />
                            @error('email')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Password</label>
                            <input type="password" id="password" wire:model="password"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="•••••••••" />
                            @error('password')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="confirm_password" class="block mb-2.5 text-sm font-medium text-heading">Confirm
                                password</label>
                            <input type="password" id="confirm_password" wire:model="password_confirmation"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="•••••••••" />
                            @error('password_confirmation')
                                <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- <form class="space-y-4 md:space-y-6" wire:submit="register">
    <div>
        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            nama</label>
        <input wire:model="name" type="text" name="nama" id="nama"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="nama">
        @error('name')
        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            email</label>
        <input wire:model="email" type="email" name="email" id="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="email@company.dns">
        @error('email')
        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
        <select wire:model="role" id="role" name="role"
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">Select role</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
        </select>
        @error('role')
        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('password')
        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
            password</label>
        <input wire:model="password_confirmation" type="password" name="confirm-password" id="confirm-password"
            placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('password_confirmation')
        <p class="mt-2.5 text-xs text-fg-danger"><span class="font-medium">{{$message}}</p>
        @enderror
    </div>
    <button type="submit"
        class="w-full cursor-pointer text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create
        an account</button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        Already have an account? <a href="/login" wire:navigate
            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
            here</a>
    </p>
</form> --}}