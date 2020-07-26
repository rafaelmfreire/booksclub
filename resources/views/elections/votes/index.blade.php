@extends('layouts.app')

@section('content')

<x-header>
    Resultado
</x-header>
<main>
    @if (Session::has('danger'))
    <alert variation="danger">{{ Session::get('danger') }}</alert>
    @endif
    <div class="max-w-7xl mx-auto py-3 sm:py-6 sm:px-6 lg:px-8 lg:grid grid-cols-2 gap-8">
        <!-- Replace with your content -->
        <div class="max-w-full">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-700 mb-2 px-4 sm:px-0">
                    Votação
                </h3>
                <div class="shadow overflow-hidden sm:rounded-lg max-w-full" style="align-self: start">
                    <div class="p-4 border-b border-gray-200 bg-white px-6 flex justify-between">
                        <div>
                            <dt class="text-xs leading-5 text-gray-400">
                                Iniciada em
                            </dt>
                            <dd class="mt-1 text-sm leading-5 font-medium text-gray-900">
                                @isset($election->start_date)
                                {{ $election->start_date->format('d/m/Y') }}
                                @endisset
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs leading-5 text-gray-400">
                                Concluída em
                            </dt>
                            <dd class="mt-1 text-sm leading-5 font-medium text-gray-900">
                                @isset($election->end_date)
                                {{ $election->end_date->format('d/m/Y') }}
                                @endisset
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <results-list election-id="{{ $election->id }}" api-token="{{ auth()->user()->api_token }}"></results-list>
                </div>
            </div>
        </div>
        <div class="">
            <h3 class="text-lg leading-6 font-medium text-gray-700 mb-2 px-4 sm:px-0">
                Votantes
            </h3>
            <div class="mx-auto">
                <!-- Replace with your content -->
                {{-- @dump($election->votes) --}}
                <div class="align-middle inline-block shadow overflow-x-auto sm:rounded-lg border-b border-gray-200 col-span-2">
                    <table class="min-w-full">
                        <tbody class="bg-white">
                            @foreach ($election->voters() as $key => $voter)
                                <tr class="hover:bg-yellow-50 odd:bg-gray-100">
                                    <td class="px-6 py-4 border-b border-gray-200 text-base sm:text-sm">
                                        {{ ucfirst($voter) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /End replace -->
    </div>
</main>

@endsection