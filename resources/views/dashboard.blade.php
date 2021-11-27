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
                    <form action="{{route('get-short-url')}}" method="POST" class="flex-col">
                        <input class="w-full m-2" type="text" name="url" value="" tabindex="1" placeholder="url" autofocus>
                        <div class="flex justify-between items-center m-2">
                            <div class="flex-grow pr-3">
                                <input class="w-full" type="text" id="name" name="name" placeholder="url name" tabindex="3">
                            </div>
                            <div class="flex-none ">
                                <input type="checkbox" id="isSecret" name="isSecret" value="1" tabindex="2">
                                <label for="isSecret">Make secret url</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <x-button class="justify-self-center" tabindex="3">
                                {{ __('GET SHORT URL')}}
                            </x-button>
                        </div>
                        @csrf
                    </form>
                    @if (isset($message))
                        <div class="alert alert-danger">
                            <ul>
                                {{ $message }}
                            </ul>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        @if(isset($link))
                            <div class="flex justify-center p-4">
                                <a href="{{$link}}">{{$linkName}}</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
