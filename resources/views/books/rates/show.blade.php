@extends('layouts.app')

@section('content')

<x-header>
    Avaliação Final
</x-header>
<main>
    @if (Session::has('danger'))
    <alert variation="danger">{{ Session::get('danger') }}</alert>
    @endif
    <div class="max-w-7xl mx-auto py-3 sm:py-6 sm:px-6 lg:px-8 lg:grid grid-cols-2 gap-8">
        <!-- Replace with your content -->
        <div class="max-w-sm">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-700 mb-2 px-4 sm:px-0">
                    Notas
                </h3>
                <div class="shadow overflow-hidden sm:rounded-lg max-w-full" style="align-self: start">
                    <div class="p-6 border-b border-gray-200 bg-white flex justify-between">
                        <div>
                            <dt class="text-xs leading-5 text-gray-400 ">
                                Sua Nota
                            </dt>
                            <dd class="mt-1 text-4xl  font-medium text-gray-900">
                                {{ $rate->rate / 10 }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs leading-5 text-gray-400">
                                Média
                            </dt>
                            <dd class="mt-1 text-4xl text-right font-medium text-gray-900">
                                {{ $book->averageRate() / 10 }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full">
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    {{-- <results-list election-id="{{ $election->id }}" api-token="{{ auth()->user()->api_token }}"></results-list> --}}
                </div>
            </div>
        </div>
        <div class="mt-5 sm:mt-0">
            <h3 class="text-lg leading-6 font-medium text-gray-700 mb-2 px-4 sm:px-0">
                Avaliações
            </h3>
            <div class="mx-auto">
                <!-- Replace with your content -->
                {{-- @dump($election->votes) --}}
                <div class="align-middle inline-block shadow overflow-x-auto sm:rounded-lg border-b border-gray-200 col-span-2">
                    <table class="min-w-full">
                        <tbody class="bg-white">
                            @foreach ($book->rates as $key => $rate)
                                <tr class="hover:bg-yellow-50 odd:bg-gray-100">
                                    <td class="px-6 py-4 border-b border-gray-200 text-base sm:text-sm">
                                        {{ ucfirst($rate->user->name) }}
                                        <span class="font-medium text-lg mt-3 sm:mt-1 block">
                                            {{ $rate->rate /10 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 leading-4 border-b border-gray-200 text-sm font-light">
                                        {{ $rate->comment }}
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