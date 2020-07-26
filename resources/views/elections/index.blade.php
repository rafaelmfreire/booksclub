@extends('layouts.app')

@section('content')

<x-header>
    Votações
    <x-slot name="button">
        <span class="sm:ml-8 shadow-sm rounded-md">
            <a href="/elections/create"
                class="group inline-flex items-center px-5 py-2 border border-indigo-300 hover:border-indigo-400 text-sm leading-5 font-medium rounded-md text-indigo-700 bg-indigo-50 hover:text-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-100 active:bg-indigo-50 transition duration-150 ease-in-out">
                <svg class="h-5 w-5 sm:mr-2 -ml-1 fill-current text-indigo-500 group-hover:text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg><svg fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                    </path>
                </svg>
                <span class="hidden sm:block">
                    Nova Votação
                </span>
            </a>
        </span>
    </x-slot>
</x-header>
<main>
    @if (Session::has('danger'))
    <alert variation="danger">{{ Session::get('danger') }}</alert>
    @endif
    <div class="max-w-7xl mx-auto py-3 sm:py-6 sm:px-6 lg:px-8">
        <div class="mb-5 text-sm">Data/Hora: <span class="font-bold">{{ now()->format('d/m/Y H:i') }}</span></div>
        <!-- Replace with your content -->
        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <elections-list current-date="{{ now()->format('Y-m-d') }}" api-token="{{ auth()->user()->api_token }}"></elections-list>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</main>

@endsection