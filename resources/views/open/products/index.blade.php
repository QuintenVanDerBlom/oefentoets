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
                                @foreach($products as $product)

                                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                                        <div
                                            class="h-full p-6 rounded-lg border-2 border-gray-300 flex flex-col relative overflow-hidden">

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
                                                {{ $product->latest_price->price }}
                                            </p>
                                            <p class="flex items-center text-gray-600 mb-6">
                                                {{ Str::limit($product->description, 150) }}
                                            </p>
                                            <div class="flex justify-center">
                                                <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded
                                                    text-lg">Add to Card</button>
                                                <a href="{{ route('open.products.show', ['product' => $product->id]) }}"> <button class="ml-4 inline-flex text-gray-700
                                                    bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Details</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </section>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




