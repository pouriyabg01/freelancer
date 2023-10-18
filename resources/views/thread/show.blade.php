<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="dark:text-white">{{$Thread->job->title}} - Messages </h2>
    <p class="dark:text-white">{{$Thread->job->description}}</p>

    <hr>

    @if(count($Thread->message) > 0)

        <table>
            @foreach($Thread->message as $Message)
                <tr>
                    <th style="padding-right: 10px;">{{$Message->user->name}}</th>
                    <td class="dark:text-white">{{$Message->message}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p class="dark:text-white">No Messages Found
    @endif

    <hr>

    <form method="POST" action="{{ route('createMessage',$Thread->id) }}">
    @csrf
    <!-- Message -->
        <div>
            <x-input-label for="message" :value="__('Message')" />
            <x-text-input id="message" class="block mt-1 w-full" type="text" name="message" :value="old('message')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Send') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
