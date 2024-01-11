<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{route('urlShorteners.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="longUrl" class="form-label">Long Url</label>
                          <input type="url" class="form-control" name="long_url" id="longUrl" aria-describedby="longUrl">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h5>Shortener url list:</h5>
                    <ul>
                        @forelse ($urls as $key => $url)
                        <li>{{$key+1}}. <u><a href="{{route('urlShorteners.clickCount', $url->id)}}" target="_blank">{{$url->short_url}}</a></u> (Click Count: {{$url->count}})</li>
                        @empty
                        <li>No url found...!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
