<div>

    <div class="p-6 text-gray-900">
        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-md mt-4">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        <a wire:wire:navigate href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create
            Category</a>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border mt-4 ">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">No.</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span
                                class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span
                                class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Slug</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50 text-left">
                            <span
                                class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                    @foreach ($categories as $category)
                        <tr class="bg-white">
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                {{ $category->slug }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                <a wire:navigate href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mx-2">Edit</a>

                                <button type="submit" onclick="return confirm('Are You Sure ?')"
                                    class="text-red-600 hover:text-red-900" wire:click="delete({{ $category->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
