<x-guest-layout>
    <form method="POST" action="{{ route('jobs.store') }}">
    @csrf

    <!-- title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"  autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <!-- description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')"  autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>


        <!-- budget -->
        <div class="mt-4">
            <x-input-label for="budget" :value="__('Budget')" />
            <x-text-input id="budget" class="block mt-1 w-full" type="number" name="budget" :value="old('budget')"  autocomplete="budget" />
            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Done') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
