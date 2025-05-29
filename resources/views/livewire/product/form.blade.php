<div class="mt-6 p-6 py-4">

    <form wire:submit.prevent="save" enctype="multipart/form-data" method="POST">

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 lg:grid-cols-2">

            <div class="mb-2 col-span-2 md:col-auto">
                <x-label for="name" :value="__('Product Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')"
                    placeholder="Product Name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="mb-2 col-span-2 md:col-auto">
                <x-label for="price" :value="__('Price')" />
                <x-input id="price" class="block mt-1 w-full" type="number" wire:model="price" :value="old('price')"
                    placeholder="Price" />
                <x-input-error for="price" class="mt-2" />
            </div>

            <div class="mb-2 col-span-2 md:col-auto">
                <x-label for="category_id" :value="__('Category')" />
                <select name="category_id" id="category_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    wire:model="category_id">
                    <option value="" selected>Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="category_id" class="mt-2" />
            </div>

            <div class="mb-2 col-span-2 md:col-auto">
                <x-label for="image" :value="__('Image')" />
                <input type="file" class="block mt-1 w-full" wire:model="image">
                <x-input-error for="image" class="mt-2" />
            </div>

            <div class="mb-2 col-span-2">
                <x-label for="description" :value="__('Description')" />
                <textarea wire:model.defer="description" rows="4" placeholder="Description"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1"></textarea>
                <x-input-error for="description" class="mt-2" />
            </div>

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-4" wire:loading.attr="disabled" wire:target="image">
                {{ 'Save' }}
            </x-button>
        </div>
    </form>

</div>
