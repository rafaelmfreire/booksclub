@extends('layouts.app')

@section('content')

<form action="{{ route('elections.update', $election) }}" method="POST">
    @csrf
    @method('PUT')

    <x-header>
        Alterar Votação
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
                        <div class="block sm:grid grid-cols-2">
                            <x-input name="start_date" type="date"
                                :value="is_null($election->start_date) ? '' : $election->start_date->format('Y-m-d')">Data de Início</x-input>
                            <x-input name="end_date" type="date"
                                :value="is_null($election->end_date) ? '' : $election->end_date->format('Y-m-d')">Data de Conclusão</x-input>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </main>
</form>

@endsection