<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Documents") }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="text-3xl">{{ __("Documents") }}</h1>
                        <a href="{{ route('documents.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New</a>
                    </div>
                    <table class="w-full text-md rounded mb-4">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">Title</th>
                                <th class="text-left p-3 px-5">Description</th>
                                <th class="text-left p-3 px-5">Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $document)
                            <tr>
                                <td class="p-3 px-5">
                                    {{ $document->title }}
                                </td>
                                <td class="p-3 px-5">
                                    {{ $document->description }}
                                </td>
                            </tr>
                            @empty
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <td class="p-3 px-5">
                                    No documents found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $documents->links() }}
        </div>
    </div>
</x-app-layout>