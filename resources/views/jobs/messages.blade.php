<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Messages') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($threads->count() <= 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You have no message yet!") }}
                    </div>
                </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <table class="custom-table">
                        <thead>
                        <tr>
                            <th>jobs</th>
                            <th>to</th>
                            <th>view</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td>{{ $thread->job->title }}</td>
                                <td>
{{--                                @foreach($thread->users->pluck('name') as $name)--}}
{{--                                    <a href="#" class="btn btn-primary">{{ $name }}</a>--}}
                                    <a href="#" class="btn btn-primary">{{ $thread->users->pluck('name')[1] }}</a>
{{--                                @endforeach--}}
                                </td>
                                <td>
                                    <a href="/thread/{{$thread->id}}" class="btn btn-primary">show</a>
                                </td>
                                <td>
                                    <form action="{{ route('thread.destroy',$thread->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button>del</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
