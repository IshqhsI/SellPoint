<div class="mt-6 p-6 py-4">

    <form wire:submit.prevent="save">

        <div class="grid grid-cols-1 gap-x-8 gap-y-4 lg:grid-cols-2">

            @foreach ($products as $index => $product)
                <div class="col-span-2 md:col-auto">
                    <x-label for="products" :value="__('Product')" />
                    <select name="products" id="products"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        wire:model="products.{{ $index }}.id" wire:change="productSelected($event.target.value, {{ $index }})">
                        <option value="" disabled selected>Select a Product</option>
                        @foreach ($allProducts as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name . ' - Rp. ' . number_format($product->price) }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="id" class="mt-2" />
                </div>

                <div class="col-span-2 md:col-auto">
                    <x-label for="quantity" :value="__('Quantity')" />
                    <x-input id="quantity" class="block mt-1 w-full" type="number"
                        wire:model.defer="products.{{ $index }}.quantity" min="1"
                        wire:change="quantityChanged($event.target.value, {{ $index }})"
                        :value="old('quantity')"
                        placeholder="Quantity" />
                    <x-input-error for="quantity" class="mt-2" />
                </div>

                @if ($index > 0)
                    <div class="col-span-2">
                        <button wire:click="removeProductField({{ $index }})" type="button"
                            class="bg-red-500 text-white px-2 rounded-md hover:bg-red-600">
                            X
                        </button>
                    </div>
                @endif
            @endforeach

            <div class="col-span-2">
                <button wire:click="addProductField" type="button"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    + Add More
                </button>
            </div>

            <div class="col-span-2 md:col-auto">
                <x-label for="status" :value="__('Status')" />
                <select name="status" id="status"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    wire:model="status">
                    <option value="" disabled selected>Select a Status</option>
                    @foreach ($allStatus as $item)
                        <option value="{{ $item }}" {{ old('status') == $item ? 'selected' : '' }}>
                            {{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error for="status" class="mt-2" />
            </div>

            <div class="col-span-2 md:col-auto">
                <x-label for="payment_method" :value="__('Payment Method')" />
                <select name="payment_method" id="payment_method"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    wire:model="payment_method">
                    <option value="" disabled selected>Select a Payment Method</option>
                    @foreach ($allPaymentMethod as $item)
                        <option value="{{ $item }}" {{ old('payment_method') == $item ? 'selected' : '' }} >
                            {{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error for="payment_method" class="mt-2" />
            </div>

            <div class="col-span-2 md:col-auto">
                <x-label for="user_id" :value="__('User')" />
                <select name="user_id" id="user_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    wire:model="user_id">
                    <option value="" disabled selected>Select a User</option>
                    @foreach ($allUsers as $item)
                        <option value="{{ $item->id }}" {{ old('user_id') == $item ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="user_id" class="mt-2" />
            </div>

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-4" type="submit">
                {{ 'Save' }}
            </x-button>
        </div>
    </form>

</div>
