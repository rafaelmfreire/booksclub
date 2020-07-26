@extends('layouts.app')

@section('content')

<x-header>
    Livros
    <x-slot name="button">
        <span class="sm:ml-8 shadow-sm rounded-md">
            <a href="/books/create"
                class="group inline-flex items-center px-5 py-2 border border-indigo-300 hover:border-indigo-400 text-sm leading-5 font-medium rounded-md text-indigo-700 bg-indigo-50 hover:text-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-100 active:bg-indigo-50 transition duration-150 ease-in-out">
               <svg class="h-5 w-5 sm:mr-2 -ml-1 fill-current text-indigo-500 group-hover:text-indigo-600" viewBox="0 0 20 20">
                    <path d="M7 4.8C5.9 4.3 4.8 4 3.5 4s-2.4.3-3.5.8v10c1.1-.5 2.2-.8 3.5-.8 1.7 0 3.2.5 4.5 1.4 1.3-.9 2.8-1.4 4.5-1.4 1.3 0 2.4.3 3.5.8v-10c-1.1-.5-2.2-.8-3.5-.8s-2.4.3-3.5.8V12c0 .6-.4 1-1 1s-1-.4-1-1V4.8z" /> 
                    <path d="M15.4 20.5c-2.8 0-5.1-2.3-5.1-5.1s2.3-5.1 5.1-5.1 5.1 2.3 5.1 5.1-2.3 5.1-5.1 5.1zm-1.8-5.2c-.1.1 0 .2 0 .2h1.6v1.6s0 .1.1.1.1 0 .1-.1v-1.6H17s.1 0 .1-.1 0-.1-.1-.1h-1.6v-1.6s0-.1-.1-.1-.1 0-.1.1v1.6h-1.6z" fill-rule="evenodd" clip-rule="evenodd" />
                    <path d="M15.4 10.8c2.6 0 4.6 2.1 4.6 4.6 0 2.6-2.1 4.6-4.6 4.6-2.6 0-4.6-2.1-4.6-4.6 0-2.6 2-4.6 4.6-4.6M13.6 16h1.2v1.2c0 .3.3.6.6.6s.6-.3.6-.6V16h1.2c.3 0 .6-.3.6-.6s-.3-.6-.6-.6H16v-1.2c0-.3-.3-.6-.6-.6s-.6.3-.6.6v1.2h-1.2c-.3 0-.6.3-.6.6.1.3.3.6.6.6m1.8-6.2c-3.1 0-5.6 2.5-5.6 5.6s2.5 5.6 5.6 5.6 5.6-2.5 5.6-5.6-2.5-5.6-5.6-5.6z" fill="#fff" /> 
                </svg>
                <span class="hidden sm:block">
                    Novo Livro
                </span>
            </a>
        </span>
    </x-slot>
</x-header>
<main>
    <div class="max-w-7xl mx-auto py-3 sm:py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <books-list api-token="{{ auth()->user()->api_token }}"></books-list>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</main>

@endsection