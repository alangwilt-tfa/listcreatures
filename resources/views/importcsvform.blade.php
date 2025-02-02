<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload your Pokedex csv') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form enctype="multipart/form-data" action="{{ route('importcsv.save')}}" method="post" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="csv_import_input" :value="__('Upload csv')" />
                            <x-text-input id="csv_import_input" name="csv_import_input" type="file" accept="text/csv"
                                class="mt-1 block w-full" required="required" />
                            <x-input-error :messages="$errors->import->get('csv_import_input')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Upload') }}</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>