<div>
    <form wire:submit.prevent="logout" method="POST">
        @csrf
        <button type="submit"
            class="text-left w-full block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
            Sign Out</button>
    </form>
</div>