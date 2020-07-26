@extends('layouts.app')

@section('content')

<form action="{{ route('elections.votes.store', $election) }}" method="POST">
    @csrf

    <x-header>
        Votação
        <x-slot name="button">
            <x-button>Votar</x-button>
        </x-slot>
    </x-header>
    <main>
        @error('books')
            <alert variation="danger">{{ $message }}</alert>
        @enderror

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 lg:grid grid-cols-3">
            <!-- Replace with your content -->
            <div class="align-middle inline-block min-w-full shadow overflow-x-auto sm:rounded-lg border-b border-gray-200 col-span-3">
                <table class="min-w-full">
                    <tbody class="bg-white">
                        @foreach ($books as $book)
                            <tr class="hover:bg-yellow-50 odd:bg-gray-100">
                                <td class="px-6 py-4 border-b border-gray-200 text-base sm:text-sm">
                                    <div class="flex flex-col sm:flex-row justify-between">
                                        <span class="font-medium">{{ $book->title }}</span>
                                        <div class="mt-3 sm:mt-0">
                                            <label class="inline-flex items-center mt-2 sm:mt-0">
                                                <input type="radio" class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out cursor-pointer" name="books[{{ $book->id }}]" value="0" checked>
                                                <span class="ml-1 md:ml-2 cursor-pointer text-xs sm:text-sm">0</span>
                                            </label>
                                            @for ($i = 1; $i < 11; $i++)
                                                <label class="inline-flex items-center ml-3 md:ml-4 mt-2 sm:mt-0">
                                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out cursor-pointer"
                                                        name="books[{{ $book->id }}]" value="{{ $i }}" @if(!is_null(old('books')) && old('books')[$book->id] == $i) checked
                                                    @endif>
                                                    <span class="ml-1 md:ml-2 cursor-pointer text-xs sm:text-sm">{{ $i }}</span>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /End replace -->
    </main>
</form>

@endsection