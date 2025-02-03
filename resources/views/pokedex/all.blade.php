<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('The pokedex') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="">
                        <div>
                            <label for="type">Type</label>
                            <select class="text-gray-900" name="type" id="type">
                                <option value=""></option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" {{ $type == $params['type'] ? 'selected="selected"' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="search" :value="__('Search')" />
                            <x-text-input id="search" name="search" value="{{ $params['search'] }}"
                                class="mt-1" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Filter') }}</x-primary-button>
                        </div>
                    </form>
                    <table class="w-full text-left">
                        <thead class="border-b">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Type 1</th>
                                <th>Type 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pokemon as $p)
                                <tr class="odd:bg-gray-200 dark:odd:bg-gray-600">
                                    <td>
                                        <img src="{{ $p->gif }}" alt="{{ $p->pokemon }} profile" style="width:64px;">
                                    </td>
                                    <td>{{ $p->pokemon }}</td>
                                    <td>{{ $p->type_1 }}</td>
                                    <td>{{ $p->type_2 }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $pokemon->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>