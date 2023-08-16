<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image Create') }}
            <x-nav-link :href="route('image.index')" :active="request()->routeIs('image.index')" class="ml-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List') }}
            </x-nav-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-50" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="mt-12 sm:mt-0">
                        <div class="md:grid md:grid-cols-6 md:gap-6">
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <form action="{{route('image.store')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 ">
                                                    <label for="title" class="block leading-6 text-gray-900">Title</label>
                                                    <input type="text" name="title" id="title" autocomplete="title" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    @error('title')
                                                    <span class="text-sm text-red-600" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6">
                                                    <label for="value" class="block leading-6 text-gray-900">Value</label>
                                                    <input type="number" name="value" value="{{old('value')}}" id="value" autocomplete="value" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    @error('value')
                                                    <span class="text-sm text-red-600" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6">
                                                    <label for="description" class="block leading-6 text-gray-900">Description</label>
                                                    <textarea name="description" id="description" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old('description')}}</textarea>
                                                    @error('description')
                                                    <span class="text-sm text-red-600" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6 ">
                                                    <label for="image" class="block leading-6 text-gray-900">Image</label>
                                                    <input type="file" name="image_file" value="{{old('image_file')}}" id="image_file" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 px-4 py-3 sm:px-6">
                                            <button
                                                    type="submit"
                                                    class="inline-block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-600">
                                                Save
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
