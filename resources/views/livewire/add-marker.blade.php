<div class="py-3 flex">
    <div class="text-gray-300 mt-3 mr-1 text-sm hidden md:flex">
        <svg fill="currentColor" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
        </svg>
    </div>

    <input wire:model.defer="url"
           type="url"
           name="url"
           class="w-full mr-3 input focus:outline-none focus:ring-primary focus:border-primary"
           placeholder="Enter URL..."
           required>
    <button wire:click="add" type="button" class="mt-2 mr-1 lg:mr-4 btn btn-sm btn-primary">add</button>
</div>
