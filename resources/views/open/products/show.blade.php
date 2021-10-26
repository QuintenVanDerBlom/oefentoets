@extends('layouts.layout2')

@section('content')

    <div class="container mx-1">
        <div class="ml-2 flex flex-col">
            <h3 class="text-xl md:text-3xl leading-tight text-center max-w-md mx-auto text-gray-900 mb-12">
                Producten overzicht
            </h3>
        </div>

        @if(session('status'))
            <div class="bg-green-200 text-green-900 rounded-lg shadow-md p-6 pr-10 mb-8"
                 style="min-width: 240px">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-8 lg:-mx-10">
                <div class="py-2 align-middle inline-block min-w-full sm:px-8 lg:px-10">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mb-10">

                        <section class="text-gray-600 body-font overflow-hidden">
                            <div class="container px-5 py-12 mx-auto">
                                <div class="flex flex-wrap -m-4">

                                    <div class="p-4 w-full">
                                        <div class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative overflow-hidden">

                                            <h1 class="text-3xl text-gray-900 pb-4 mb-4 border-b border-gray-200 leading-none">
                                                {{ $product->name }}</h1>
                                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Categorie: {{ $product->category->name }}</h2>
                                            <!-- List of items -->
                                            <p class="flex items-center text-gray-600 mb-6">
                                            <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                     stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                                    <path d="M20 6L9 17l-5-5"></path>
                                                </svg>
                                            </span>
                                                Prijs: {{ $product->latest_price->price }}
                                            </p>
                                            <p class="text-left text-gray-600 mb-6">
                                                {{ $product->description }}
                                            </p>
                                            <div class="flex justify-center">
                                                <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none
                                                    hover:bg-indigo-600 rounded text-lg">Add to Card</button>
                                                <a href="{{ route('open.products.index') }}"><button class="ml-4 inline-flex text-gray-700 bg-gray-100
                                                    border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Naar overzicht</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="-my-2 overflow-x-auto sm:-mx-8 lg:-mx-10">
                                <div class="flex w-full p-8 border-b border-gray-300">
                                    <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                                    <div class="flex flex-col flex-grow ml-4">
                                        <div class="flex">
                                            <span class="font-semibold">Username</span>
                                            <span class="ml-1">@username</span>
                                            <span class="ml-auto text-sm">Just now</span>
                                        </div>
                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <a class="underline" href="#">#hashtag</a></p>
                                        <div class="flex mt-2">
                                            <button class="text-sm font-semibold">Like</button>
                                            <button class="ml-2 text-sm font-semibold">Reply</button>
                                            <button class="ml-2 text-sm font-semibold">Share</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full p-8 border-b border-gray-300">
                                    <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                                    <div class="flex flex-col flex-grow ml-4">
                                        <div class="flex">
                                            <span class="font-semibold">Username</span>
                                            <span class="ml-1">@username</span>
                                            <span class="ml-auto text-sm">Just now</span>
                                        </div>
                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <a class="underline" href="#">#hashtag</a></p>
                                        <div class="flex mt-2">
                                            <button class="text-sm font-semibold">Like</button>
                                            <button class="ml-2 text-sm font-semibold">Reply</button>
                                            <button class="ml-2 text-sm font-semibold">Share</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







