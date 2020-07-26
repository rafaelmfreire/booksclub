@extends('layouts.app')

@section('content')

<form action="/books/{{ $book->id }}/rates" method="POST">
    @csrf

    <x-header>
        <div>
            {{ $book->title }}
            <p class="text-base font-normal text-gray-700">
                {{ $book->author }}
            </p>
        </div>
        <x-slot name="button">
            <x-button>Avaliar</x-button>
        </x-slot>
    </x-header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 ">
            <!-- Replace with your content -->
            <div class="shadow overflow-hidden sm:rounded-lg max-w-full">
                <div class="bg-white">
                    <div class="px-4 py-6 max-w-lg">
                        <div class="block sm:grid grid-cols-2">
                            <x-input name="rate" value="0.0" type="number" step="0.1" min="0.0" max="5.0">Nota</x-input>
                        </div>
                        <x-textarea name="comment">Comentários</x-area>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-sm text-red-400">Obs.: Ao avaliar, o livro será marcado como lido e não aparecerá mais em outras votações.</div>
            <!-- /End replace -->
        </div>
    </main>
</form>

@endsection