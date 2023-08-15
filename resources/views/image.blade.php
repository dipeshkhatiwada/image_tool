<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.guest_navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        <div class="py-1">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-blue-600 rounded-lg bg-blue-50 " role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-50" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="items-center text-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                            {{ __('Image details') }}
                        </h2>
                    </div>
                    <div class="p-2 text-gray-900 flex">
                        <a href="{{route('home.image', $image->id)}}">
                            <img class="rounded-t-lg" src="{{asset('images/' . $image->image)}}"
                                 alt="{{ $image->title }}" style="max-height: 300px;"/>
                        </a>
                        <div class="mb-3 p-5">
                            <a href="{{route('home.image', $image->id)}}">
                                <h5 class="ml-3 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $image->title }}
                                </h5>
                            </a>
                            <p class="ml-3 mb-3 font-normal text-gray-700 dark:text-gray-400">Value : {{$image->value}} .</p>
                            <p class="ml-3 mb-3 font-normal text-gray-700 dark:text-gray-400">{{$image->visits->count()}}
                                Views.</p>
                            <p class="ml-3 mb-3 font-normal text-gray-700 dark:text-gray-400">Description: {{ $image->description }}.</p>
                        </div>
                    </div>
                    <div class="p-2 text-gray-900 flex">
                        @if(count($comments))
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Comments
                            </h5>
                            @foreach($comments as $cmt)
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$cmt->addedBy->name}} : " {{$cmt->message}}. "</p>
                            <hr>

                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="p-2">
                    <div class="p-5">
                        @if(Auth::check())
                            <form action="{{route('comment.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h3>Add Comments </h3>
                                <input type="hidden" name="image_id" id="image_id" value="{{$image->id}}">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-1 mb-5">
                                            <div class="col-span-12">
                                                <label for="description" class="block leading-6 text-gray-900">Add a comment message</label>
                                                <textarea name="message" id="message" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old('message')}}</textarea>
                                                @error('message')
                                                <span class="text-sm text-red-600" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" id="submit" value="submit"class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </main>
</div>
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
</body>
</html>
