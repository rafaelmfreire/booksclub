@extends('layouts.app')

@section('content')

<form action="/books" method="POST">
    @csrf

    <x-header>
        Novo Livro
        <x-slot name="button">
            <x-button>Salvar</x-button>
        </x-slot>
    </x-header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 lg:grid grid-cols-2 gap-8">
            <!-- Replace with your content -->
            <div class="shadow overflow-hidden sm:rounded-lg max-w-full">
                <div class="bg-white">
                    <div class="px-4 py-6">
                        <x-input name="title" >Título</x-input>
                        <x-input name="author" >Autor</x-input>
                    </div>
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>
</form>

@endsection