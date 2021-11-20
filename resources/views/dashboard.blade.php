<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('get-short-url')}}" method="POST">
                        <input type="text" name="url" value="" tabindex="1" placeholder="Enter url" autofocus>
                        <input type="submit" name="submit" value="GET">
                        @csrf
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(isset($link))
                        <a href="{{$link}}">{{$link}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
