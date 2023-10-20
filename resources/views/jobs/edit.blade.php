<x-guest-layout>
    <form method="POST" action="{{ route('jobs.update',$job->id) }}">
    @csrf
    @method("PUT")

    <!-- title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$job->title" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- description -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$job->description" required autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>

        <!-- category -->
        <div class="mt-4">
            <x-input-label for="category" :value="__('Category')" />
            <select multiple id="category" name="category[]" class="form-select mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-200 dark:focus:ring-offset-gray-800 focus:ring-opacity-50">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(in_array($category->id , $jobCategory)) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>


        <!-- budget -->
        <div class="mt-4">
            <x-input-label for="budget" :value="__('Budget')" />
            <x-text-input id="budget" class="block mt-1 w-full" type="number" name="budget" :value="$job->budget" required autocomplete="budget" />
            <x-input-error :messages="$errors->get('budget')" class="mt-2" />
        </div>




        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Done') }}
            </x-primary-button>
        </div>
    </form>
    <a href="{{ url('profile/jobs/'.$job->id) }}" class="dark:text-white">back</a>
</x-guest-layout>
