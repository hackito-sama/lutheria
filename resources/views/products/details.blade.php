@extends('Layout.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-8">

            {{-- Image Gallery Section & Product Description --}}
            <div class="md:col-span-1 lg:col-span-2 flex flex-col items-center">
                {{-- Main Product Image --}}
                <div class="w-full mb-4">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                        class="w-full h-auto rounded-lg shadow-md object-contain">
                </div>

                {{-- Thumbnail Images --}}
                <div class="flex flex-wrap justify-center gap-2 mt-4 w-full">
                    @foreach(json_decode($product->images) as $image)
                        <div
                            class="w-20 h-20 bg-gray-100 rounded-md overflow-hidden cursor-pointer shadow-sm border border-gray-300 hover:border-blue-500 transition-colors">
                            <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                {{-- Product Description --}}
                <div class="mt-8 w-full">
                    <h3 class="text-xl font-semibold text-luth-blue">Descripción</h3>
                    <p class="text-gray-600 mt-2 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800">Especificaciones Técnicas</h3>

                    <div class="mt-4 overflow-x-auto rounded-lg shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200 bg-white">
                            <tbody class="divide-y divide-gray-200">
                                @foreach($fichaTecnica as $key => $value)
                                    @if(is_array($value))
                                        {{-- Encabezado para la sección anidada --}}
                                        <tr class="bg-gray-50">
                                            <td colspan="2"
                                                class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider text-gray-700">
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}
                                            </td>
                                        </tr>
                                        {{-- Contenido de la sección anidada --}}
                                        @foreach($value as $subKey => $subValue)
                                            @if(is_array($subValue))
                                                {{-- Encabezado para la subsección anidada --}}
                                                <tr class="bg-white">
                                                    <td colspan="2" class="px-6 py-2 text-left font-semibold text-gray-700">
                                                        &nbsp; &nbsp; {{ ucfirst(str_replace('_', ' ', $subKey)) }}
                                                    </td>
                                                </tr>
                                                {{-- Contenido de la subsección anidada --}}
                                                @foreach($subValue as $deepKey => $deepValue)
                                                    <tr class="bg-white">
                                                        <td class="px-8 py-2 text-sm text-gray-500">
                                                            {{ ucfirst(str_replace('_', ' ', $deepKey)) }}
                                                        </td>
                                                        <td class="px-6 py-2 text-sm font-medium text-gray-900">
                                                            {{ is_array($deepValue) ? json_encode($deepValue, JSON_UNESCAPED_UNICODE) : $deepValue }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                {{-- Pares clave-valor simples dentro de un array anidado --}}
                                                <tr class="bg-white">
                                                    <td class="px-6 py-2 text-sm text-gray-500">
                                                        {{ ucfirst(str_replace('_', ' ', $subKey)) }}
                                                    </td>
                                                    <td class="px-6 py-2 text-sm font-medium text-gray-900">
                                                        {{ is_array($subValue) ? json_encode($subValue, JSON_UNESCAPED_UNICODE) : $subValue }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        {{-- Pares clave-valor simples en el nivel superior --}}
                                        <tr class="bg-white">
                                            <td class="px-6 py-2 text-sm text-gray-500">{{ ucfirst(str_replace('_', ' ', $key)) }}
                                            </td>
                                            <td class="px-6 py-2 text-sm font-medium text-gray-900">
                                                {{ is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- Product Information & Actions Section --}}
            <div class="mt-8 md:mt-0 md:col-span-1 lg:col-span-1">
                <h1 class="text-3xl font-bold text-luth-blue">{{ $product->name }}</h1>

                {{-- Price Section --}}
                <div class="my-6">
                    <span
                        class="text-4xl font-extrabold text-luth-blue">${{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                {{-- Quantity Input --}}
                <div class="mb-4">
                    <label for="product-qty-{{ $product->id }}"
                        class="block text-gray-700 font-medium mb-1">Cantidad</label>
                    <input type="number" id="product-qty-{{ $product->id }}"
                        class="w-24 px-3 py-2 border rounded-lg text-center" value="1" min="1"
                        max="{{ $product->stock ?? 999 }}">
                    <span class="text-sm text-gray-500 ml-2">Stock: {{ $product->stock ?? '∞' }}</span>
                </div>

                {{-- Action Buttons --}}
                <div class="space-y-4">
                    <!--<button type="button"
                        class="add-to-cart w-full py-3 px-6 text-white font-bold rounded-lg transition-colors duration-200 bg-luth-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-luth-blue focus:ring-opacity-50"
                        data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}"
                        data-image="{{ $product->image ?? '' }}">
                        <i class="fas fa-shopping-cart mr-2"></i> Agregar al Carro
                    </button>-->
                    <a href="https://wa.me/{{ $whatsapp }}?text={{ urlencode('Hola, quiero consultar por el producto: ' . $product->name . ' - Precio: $' . $product->price) }}"
                        target="_blank"
                        class="w-full py-3 px-6 text-white font-bold rounded-lg transition-colors duration-200 bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        <i class="fab fa-whatsapp mr-2"></i> Consultar por WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/cart/cart.js')
    @vite('resources/js/cart/cart.js')
@endsection