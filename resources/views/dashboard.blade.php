<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Url Shortener') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-center mt-5 text-4xl">Generate Short Url</h2>
                    <form action="{{route('get-short-url')}}" method="POST" class="flex-col">
                        <input class="w-full m-2" type="text" value="{{ old('url') }}" name="url" value="" tabindex="1" placeholder="url" autofocus>
                        <div class="flex justify-between items-center m-2">
                            <div class="flex-grow pr-3">
                                <input class="w-full" type="text" value="{{ old('name') }}" id="name" name="name" placeholder="url name" tabindex="3">
                            </div>
                            <div class="flex-none pr-3">
                                <div class="flex-col">
                                    <label for="date">Time to Live</label>
                                    <input type="date" value="{{ old('date') }}" id="date" name="date" placeholder="url name" tabindex="3">
                                </div>
                            </div>
                            <div class="flex-none">
                                <input type="checkbox" id="isSecret" name="isSecret" value="1" tabindex="2" {{ old('isSecret') ? 'checked' : ''}}>
                                <label for="isSecret">Make secret url</label>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6">
                            <x-button class="justify-self-center transition delay-150 duration-300 ease-in-out" tabindex="3">
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
                    @if (isset($top))
                        <h2 class="text-center mt-20 text-4xl">Your most popular urls</h2>
                        <table class="border-collapse w-full m-2 border border-green-800 ...">
                            <thead>
                                <tr>
                                    <th class="border">Domain</th>
                                    <th class="border">Short Url</th>
                                    <th class="border">Secret Key</th>
                                    <th class="border">Count click</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top as $item)
                                    <tr>
                                        <td class="border">{{$item->domain}}</td>
                                        <td class="border">
                                            <a href="{{$item->short_key . ($item->secret_key ? '/' . $item->secret_key : '')}}">
                                                {{$item->short_key}}
                                            </a>
                                        </td>
                                        <td class="border">{{$item->secret_key}}</td>
                                        <td class="border">{{$item->statistics_count}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
