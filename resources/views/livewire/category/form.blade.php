<div class="mt-6 p-6 py-4" >

    <form wire:submit.prevent="save">
        <div>
            <x-label for="name" :value="__('Category Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-4">
                {{ 'Save' }}
            </x-button>
        </div>
    </form>

</div>
