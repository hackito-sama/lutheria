@extends('layout.app')

@section('content')
    <section class="py-16 bg-gray-100">
        <div id="cart-container" class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Carro de Compras</h2>

            @if(count($cartItems) > 0)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <table class="w-full text-left hidden md:table" id="cart-table">
                        <thead>
                            <tr class="border-b text-gray-600">
                                <th class="py-2 text-luth-blue">Producto</th>
                                <th class="py-2 text-luth-blue">Precio</th>
                                <th class="py-2 text-luth-blue">Cantidad</th>
                                <th class="py-2 text-luth-blue">Total</th>
                                <th class="py-2 text-luth-blue">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $id => $item)
                                <tr class="border-b text-gray-600">
                                    <td class="py-2 text-luth-blue">
                                        <a href="{{ route('products.show', $id) }}"
                                            class="text-luth-blue hover:underline font-semibold">
                                            {{ $item['name'] }}
                                        </a>
                                    </td>
                                    <td class="py-2 text-luth-blue">${{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="py-2 text-luth-blue">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button type="button"
                                                class="decrease-qty bg-gray-200 text-gray-700 px-2 rounded hover:bg-gray-300 transition disabled:opacity-50"
                                                data-id="{{ $id }}" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <span id="qty-{{ $id }}" class="px-3 font-semibold">{{ $item['quantity'] }}</span>

                                            <button type="button"
                                                class="increase-qty bg-gray-200 text-gray-700 px-2 rounded hover:bg-gray-300 transition disabled:opacity-50"
                                                data-id="{{ $id }}" data-stock="{{ $item['stock'] ?? 999 }}" {{ $item['quantity'] >= ($item['stock'] ?? 999) ? 'disabled' : '' }}>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="py-2 text-luth-blue">
                                        ${{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td class="py-2 text-center">
                                        <button data-id="{{ $id }}" type="button"
                                            class="remove-from-cart text-luth-blue hover:text-red-800 transition" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="md:hidden space-y-4">
                        @foreach($cartItems as $id => $item)
                            <div class="bg-white rounded-lg shadow p-4">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-luth-blue">Producto:</span>
                                    <span class="text-gray-600">{{ $item['name'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold text-luth-blue">Precio:</span>
                                    <span class="text-gray-600">${{ number_format($item['price'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="font-semibold text-luth-blue">Cantidad:</span>
                                    <div class="flex items-center space-x-2">
                                        <!-- Botones + - -->
                                    </div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <span class="font-semibold text-luth-blue">Total:</span>
                                    <span
                                        class="text-gray-600">${{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-end mt-2">
                                    <!-- Botón eliminar -->
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-right mt-4">
                        <span class="text-luth-blue font-bold">Total: </span>
                        <span id="cart-total" class="text-luth-blue font-bold">
                            ${{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Seguir comprando</a>
                        <a href="{{ route('payment.index') }}"
                            class="bg-luth-blue text-white px-6 py-2 rounded-lg shadow hover:bg-green-700">Ir a pagar</a>
                    </div>
                </div>
            @else
                <p class="text-gray-600">Tu carro está vacío. <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Ver
                        productos</a></p>
            @endif
        </div>
    </section>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('success') }}", 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('error') }}", 'error');
            });
        </script>
    @endif
@endsection

@section('scripts')
    @vite('resources/js/cart/remove.js')
@endsection