<template>
<div>
    <div class="mt-1 mb-1 relative rounded-md flex items-center">
        <div class="items-center hidden sm:flex">
            <div class="w-1/3 relative">

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg v-if="!loading" class="fill-current text-gray-300 w-5 h-5" viewBox="0 0 20 20"> <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" fill-rule="evenodd"></path> </svg>
                    <svg v-if="loading" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="w-5 h-5"> <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/> <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/> </path> </svg>
                </div>

                <input id="search" v-model="search" @keyup="fetchPaginateBooks(pagination.first_page_url)" class="form-input block w-full pl-10 pr-12 sm:text-sm sm:leading-5" placeholder="Busque pelo título..." />

                <div v-if="search!=''" @click="search=''; fetchPaginateBooks(pagination.first_page_url)" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg fill="currentColor" class="fill-current text-gray-300 w-5 h-5 hover:text-gray-700 cursor-pointer" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </div>

            </div>
            <div class="w-1/3 relative ml-4">

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg v-if="!loading" class="fill-current text-gray-300 w-5 h-5" viewBox="0 0 20 20"> <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" fill-rule="evenodd"></path> </svg>
                    <svg v-if="loading" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="w-5 h-5"> <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/> <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/> </path> </svg>
                </div>

                <input id="author" v-model="author" @keyup="fetchPaginateBooks(pagination.first_page_url)" class="form-input block w-full pl-10 pr-12 sm:text-sm sm:leading-5" placeholder="Busque pelo autor..." />

                <div v-if="author!=''" @click="author=''; fetchPaginateBooks(pagination.first_page_url)" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg fill="currentColor" class="fill-current text-gray-300 w-5 h-5 hover:text-gray-700 cursor-pointer" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </div>

            </div>
            <span class="sm:ml-3 shadow-sm rounded-md">
                <button @click="search=''; author=''; fetchPaginateBooks(pagination.first_page_url)" 
                    class="px-4 py-2 flex items-center border border-gray-300 hover:border-gray-400 text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-50 hover:text-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-100 active:bg-gray-50 transition duration-150 ease-in-out">
                    <svg class="fill-current w-4 h-4 mr-2" viewBox="0 0 20 20">
                        <path d="M18 3H8.446c-.44 0-1.071.236-1.402.525L.248 9.473a.682.682 0 000 1.053l6.796 5.947c.331.289.962.527 1.402.527H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2.809 11l-2.557-2.557L10.078 14l-1.443-1.443L11.191 10 8.635 7.443 10.078 6l2.557 2.555L15.19 6l1.444 1.443L14.078 10l2.557 2.555L15.191 14z"/>
                    </svg>
                    <span>Limpar</span>
                </button>
            </span>
        </div>

        <span class="sm:hidden shadow-sm rounded-md absolute left-0 inset-y-0 ml-4">
            <div class=" flex items-center">
                <button @click="showFilters=true" class="flex items-center px-4 py-2 border border-gray-300 hover:border-gray-400 text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-50 hover:text-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-100 active:bg-gray-50 transition duration-150 ease-in-out">
                    <svg class="fill-current h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path></svg>
                    <span class="ml-2">Filtros</span>
                </button>
                <svg v-if="loading" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="w-5 h-5 ml-4"> <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/> <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/> </path> </svg>
            </div>
        </span>

        <transition name="slide-fade" @enter="showContent=true">
            <div v-if="showFilters" class="fixed inset-0 overflow-hidden z-50 sm:hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <transition name="fade" @leave="showFilters=false">
                        <div v-if="showContent" @click="showContent=false" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    </transition>
                    <section class="absolute inset-y-0 right-0 pl-16 max-w-full flex">
                        <div class="relative w-screen max-w-md">
                            <div class="absolute top-0 left-0 -ml-12 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                                <button @click="showContent=false" aria-label="Close panel" class="text-white bg-gray-700 rounded-md p-1 transition ease-in-out duration-150">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="flex items-center justify-between">
                                    <header class="px-4 sm:px-6">
                                        <h4 class="text-lg leading-7 font-medium text-gray-900">
                                            Filtros
                                        </h4>
                                    </header>
                                    <span class=" shadow-sm rounded-md mr-4 sm:mr-6">
                                        <button @click="search=''; author=''; fetchPaginateBooks(pagination.first_page_url)" 
                                            class="px-4 py-2 flex items-center border border-gray-300 hover:border-gray-400 text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-50 hover:text-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-100 active:bg-gray-50 transition duration-150 ease-in-out">
                                            <svg class="fill-current w-4 h-4 mr-2" viewBox="0 0 20 20">
                                                <path d="M18 3H8.446c-.44 0-1.071.236-1.402.525L.248 9.473a.682.682 0 000 1.053l6.796 5.947c.331.289.962.527 1.402.527H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2.809 11l-2.557-2.557L10.078 14l-1.443-1.443L11.191 10 8.635 7.443 10.078 6l2.557 2.555L15.19 6l1.444 1.443L14.078 10l2.557 2.555L15.191 14z"/>
                                            </svg>
                                            <span>Limpar</span>
                                        </button>
                                    </span>
                                </div>
                                <div class="relative flex-1 px-4 sm:px-6">
                                    <div class="absolute inset-0 px-4 sm:px-6">
                                        <div class="h-full">

                                            <div class="w-full relative">

                                                <div class="absolute inset-y-0 left-0 pl-3 mt-5 flex items-center pointer-events-none">
                                                    <svg v-if="!loading" class="fill-current text-gray-300 w-5 h-5" viewBox="0 0 20 20"> <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" fill-rule="evenodd"></path> </svg>
                                                    <svg v-if="loading" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="w-5 h-5"> <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/> <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/> </path> </svg>
                                                </div>

                                                <label for="search" class="block text-sm leading-5 font-medium text-gray-700 ml-1">Livro</label>
                                                <input id="search" v-model="search" @keyup="fetchPaginateBooks(pagination.first_page_url)" class="form-input block w-full pl-10 pr-12 sm:text-sm sm:leading-5" placeholder="Busque pelo título..." />

                                                <div v-if="search!=''" @click="search=''; fetchPaginateBooks(pagination.first_page_url)" class="absolute inset-y-0 right-0 pr-3 mt-5 flex items-center">
                                                    <svg fill="currentColor" class="fill-current text-gray-300 w-5 h-5 hover:text-gray-700 cursor-pointer" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                                </div>

                                            </div>
                                            
                                            <div class="w-full relative mt-5">

                                                <div class="absolute inset-y-0 left-0 pl-3 mt-5 flex items-center pointer-events-none">
                                                    <svg v-if="!loading" class="fill-current text-gray-300 w-5 h-5" viewBox="0 0 20 20"> <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" fill-rule="evenodd"></path> </svg>
                                                    <svg v-if="loading" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve" class="w-5 h-5"> <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/> <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/> </path> </svg>
                                                </div>

                                                <label for="author" class="block text-sm leading-5 font-medium text-gray-700 ml-1">Autor</label>
                                                <input id="author" v-model="author" @keyup="fetchPaginateBooks(pagination.first_page_url)" class="form-input block w-full pl-10 pr-12 sm:text-sm sm:leading-5" placeholder="Busque pelo autor..." />

                                                <div v-if="author!=''" @click="author=''; fetchPaginateBooks(pagination.first_page_url)" class="absolute inset-y-0 right-0 pr-3 mt-5 flex items-center">
                                                    <svg fill="currentColor" class="fill-current text-gray-300 w-5 h-5 hover:text-gray-700 cursor-pointer" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </transition>

    </div>
    <div class="mt-12 sm:mt-6 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" @click="sort($event, 'title')" class="flex items-center">
                            Título
                            <svg v-if="sortDirection == 'desc' && sortProperty == 'title'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            <svg v-if="sortDirection == 'asc' && sortProperty == 'title'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                        </a>
                    </th>
                    <th class="px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Indicado Por
                    </th>
                    <th class="px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Finalizado
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="hover:bg-yellow-50 odd:bg-gray-100"
                    v-for="(row, index) in list" :key="index" ref="booksList">

                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="text-base leading-5 font-medium">
                            <!-- <a :href="`/books/${row.id}`" class="cursor-pointer text-indigo-700 hover:text-indigo-900 hover:underline"> -->
                                {{ row.title }}
                            <!-- </a> -->
                        </div>

                        <div class="text-xs leading-5 text-gray-500">
                            {{ row.author }}
                        </div> 
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-500">
                            {{ row.user.name }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                        <div v-if="row.read" class="text-xs leading-5 text-green-700 font-medium ml-2 flex">
                            <p class="bg-green-100 rounded px-2">Sim</p>
                        </div>
                        <div v-else class="text-xs leading-5 text-red-700 font-medium ml-2 flex">
                            <p class="bg-red-100 rounded px-2">Não</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <div class="flex justify-end">
                            <a :href="`/books/${row.id}/rates/create`" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">
                                <div class="flex items-center">
                                    <span>Avaliação</span>
                                    <svg  class="h-5 w-5 sm:mr-2 ml-1 fill-current text-indigo-500 group-hover:text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </a>
                            <btn-delete-component @clicked="onDeleted" class="ml-5" link="true" route="/api/v1/books/" :item="row" :id="row.id" :api-token="apiToken" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex sm:hidden">
                <button type="button" @click="fetchPaginateBooks(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" 
                    class="relative inline-flex items-center px-8 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous"
                    v-bind:class="{ 'bg-gray-200 text-gray-400 cursor-default': !pagination.prev_page_url, 'text-gray-700 hover:text-gray-400 bg-white': pagination.prev_page_url }">
                    Anterior
                </button>
                <button type="button" @click="fetchPaginateBooks(pagination.next_page_url)" :disabled="!pagination.next_page_url" 
                    class="-ml-px relative inline-flex items-center px-8 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next"
                    v-bind:class="{ 'bg-gray-200 text-gray-400 cursor-default': !pagination.next_page_url, 'text-gray-700 hover:text-gray-400 bg-white': pagination.next_page_url }">
                    Próxima
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm leading-5 text-gray-700">
                        <span class="font-medium">{{ pagination.from }}</span>
                        -
                        <span class="font-medium">{{ pagination.to }}</span>
                        de
                        <span class="font-medium">{{ pagination.total }}</span>
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex shadow-sm">
                        <button type="button" @click="fetchPaginateBooks(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" 
                            class="relative inline-flex items-center px-8 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous"
                            v-bind:class="{ 'bg-gray-200 text-gray-400 cursor-default': !pagination.prev_page_url, 'text-gray-700 hover:text-gray-400 bg-white': pagination.prev_page_url }">
                            Anterior
                        </button>
                        <button type="button" @click="fetchPaginateBooks(pagination.next_page_url)" :disabled="!pagination.next_page_url" 
                            class="-ml-px relative inline-flex items-center px-8 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next"
                            v-bind:class="{ 'bg-gray-200 text-gray-400 cursor-default': !pagination.next_page_url, 'text-gray-700 hover:text-gray-400 bg-white': pagination.next_page_url }">
                            Próxima
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            list: [],
            sortProperty: 'title',
            sortDirection: 'asc',
            apiToken_prop: this.apiToken,
            show: false,
            showFilters: false,
            showContent: false,
            search: '',
            author: '',
            url: '/api/v1/books/list',
            pagination: [],
            loading: false,
        }
    },
    props: ['apiToken', 'types'],
    methods: {
        cancelDelete () {
            this.show = false;
        },
        submitDelete: function() {
            this.show = true;
            event.preventDefault();
        },
        confirmDelete() {
            this.$refs.formDelete.submit();
        },
        getBooks() {
                this.loading = true
                let $this = this

                let token_url = ''
                let titleFilter = '&title='+this.search
                let authorFilter = '&author='+this.author
                let sort = '&sortP='+this.sortProperty+'&sortD='+this.sortDirection

                if(Array.isArray(this.pagination)){
                    token_url = '?api_token='+this.apiToken;
                } else {
                    token_url = '&api_token='+this.apiToken;
                }

                axios.get(this.url+token_url+titleFilter+authorFilter+sort).then(result => {
                    $this.list = result.data.data
                    $this.makePagination(result.data)
                    $this.loading = false
                })
        },
            makePagination(data) {
                let pagination = {
                    from: data.from,
                    to: data.to,
                    total: data.total,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    first_page_url: data.first_page_url
                }

                this.pagination = pagination
            },
            fetchPaginateBooks(url) {
                this.url = url
                this.getBooks()
            },
        sort( ev, property ){
            ev.preventDefault()

            this.sortProperty = property
            if(this.sortDirection == 'asc'){
                this.sortDirection = 'desc'
            } else {
                this.sortDirection = 'asc'
            }
                this.fetchPaginateBooks(this.pagination.first_page_url);
        },
        onDeleted: function(barCode) {
            const barCodeIndex = this.list.findIndex(code => code === barCode)
            if (barCodeIndex >= 0) {
                this.list.splice(barCodeIndex, 1)
            }
        },
    },
    created() {
        const handleEscape = (e) => {
            if (e.key === 'Esc' || e.key === 'Escape'){
                this.show = false
            }
        }
        document.addEventListener('keydown', handleEscape)
        this.$once('hook:beforeDestroy', () => {
            document.removeEventListener('keydown', handleEscape)
        })
    },
    mounted() {
        this.getBooks()
    },
}
</script>
<style>
.has-tooltip:hover {
position: relative;
}

.has-tooltip:hover span {
display: block;
}
</style>