<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comment List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full border-solid text-left text-gray-500 ">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 ">
                            <tr class="bg-white border-b">
                                <th class="px-6 py-3 text-gray-900">
                                    Image Title
                                </th>
                                <th class="px-6 py-3 text-gray-900">
                                    Image
                                </th>
                                <th class="px-6 py-3 text-gray-900">
                                    Comment BY
                                </th>
                                <th class="px-6 py-3 text-gray-900">
                                    Message
                                </th>
                                <th scope="col" class="px-6 py-3 text-gray-900">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($comments as $comment)
                                <tr class="bg-white border-b ">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$comment->image->title}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{$comment->description}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{$comment->addedBy->name}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{$comment->message}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                class="inline-block focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                type="button">
                                            Delete
                                        </button>
                                        <div id="popup-modal" tabindex="-1"
                                             class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                            <div class="relative w-full h-full max-w-md md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button"
                                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                            data-modal-hide="popup-modal">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <form action="{{route('image.destroy',$image->id)}}" method="POST"
                                                          style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="p-6 text-center">
                                                            <svg aria-hidden="true"
                                                                 class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                Are you sure you want to delete this Comment?</h3>
                                                            <button data-modal-hide="popup-modal" type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Delete
                                                            </button>
                                                    </form>
                                                    <button data-modal-hide="popup-modal" type="button"
                                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                    </div>

                    </td>
                    </tr>
                    @empty
                        <tr class="bg-white border-b ">
                            <td colspan="7" class="px-6 py-4 p-auto">
                                Comment not found !!
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
