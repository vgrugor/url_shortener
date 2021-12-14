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
                    @if (\Session::has('message'))
                        <div>
                            <ul>
                                <li>
                                    <span class="text-green-400">{{\Session::get('message')}}</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('error'))
                        <div>
                            <ul>
                                <li>
                                    <span class="text-red-500">{{\Session::get('error')}}</span>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <h2 class="text-center mt-5 text-4xl">Managing urls</h2>
                    <table class="border-collapse w-full m-2 border border-green-800 ...">
                        <thead>
                        <tr>
                            <th class="border">URL</th>
                            <th class="border">Short Url</th>
                            <th class="border">Secret Key</th>
                            <th class="border">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach($urls as $url)
                            <tr>
                                <td class="border">
                                    <a href="{{$url->url}}">
                                        {{ \Illuminate\Support\Str::limit($url->url, 70, $end='...') }}
                                    </a>
                                </td>
                                <td class="border">
                                    <a href="{{$url->short_key . ($url->secret_key ? '/' . $url->secret_key : '')}}">
                                        {{$url->short_key}}
                                    </a>
                                </td>
                                <td class="border">{{$url->secret_key}}</td>
                                <td class="border">
                                    <a href="{{route('destroy', ['shortKey' => $url->short_key])}}" class="text-red-500" tabindex="3">
                                        {{ __('Delete')}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center">
                        {{ $urls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
