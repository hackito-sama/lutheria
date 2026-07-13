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
                    <!--mobile-->
                    <div class="md:hidden space-y-4">
                        @foreach($cartItems as $id => $item)
                            <div id="card-mobile-{{ $id }}" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">

                                <a href="{{ route('products.show', $id) }}"
                                    class="block text-lg font-bold text-luth-blue mb-4">
                                    {{ $item['name'] }}
                                </a>

                                <div class="space-y-2 text-sm">

                                    <div class="flex justify-between">
                                        <span class="font-semibold text-luth-blue">Precio</span>
                                        <span>${{ number_format($item['price'],0,',','.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-luth-blue">
                                            Cantidad
                                        </span>
                                        <div class="flex items-center gap-3">
                                            <button
                                                type="button"
                                                class="decrease-qty w-8 h-8 rounded bg-gray-200 hover:bg-gray-300"
                                                data-id="{{ $id }}"
                                                {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>

                                                <i class="fas fa-minus"></i>

                                            </button>
                                            <span id="qty-mobile-{{ $id }}" class="font-bold text-lg">
                                                {{ $item['quantity'] }}
                                            </span>
                                            <button
                                                type="button"
                                                class="increase-qty w-8 h-8 rounded bg-gray-200 hover:bg-gray-300"
                                                data-id="{{ $id }}"
                                                data-stock="{{ $item['stock'] ?? 999 }}"
                                                {{ $item['quantity'] >= ($item['stock'] ?? 999) ? 'disabled' : '' }}>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-luth-blue">
                                            Total
                                        </span>
                                        <span id="subtotal-mobile-{{ $id }}" class="font-bold">
                                            ${{ number_format($item['price'] * $item['quantity'],0,',','.') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button
                                        data-id="{{ $id }}"
                                        class="remove-from-cart text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>
                                        Eliminar
                                    </button>
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
                        <!--<a href="{{ route('payment.index') }}"
                            class="bg-luth-blue text-white px-6 py-2 rounded-lg shadow hover:bg-green-700">
                            Ir a pagar
                        </a>-->
                        <button id="send-whatsapp-cart" type="button"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700 flex items-center gap-2">
                            <i class="fab fa-whatsapp"></i>
                            Enviar pedido por WhatsApp
                        </button>
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
    <script>
        document.getElementById('send-whatsapp-cart').addEventListener('click', () => {

            let message = "¡Hola! 👋\n";
            message += "Me gustaría cotizar los siguientes productos:\n\n";

            const rows = document.querySelectorAll('#cart-table tbody tr');

            rows.forEach(row => {

                const product = row.querySelector('td:nth-child(1)').innerText.trim();
                const price = row.querySelector('td:nth-child(2)').innerText.trim();
                const quantity = row.querySelector('[id^="qty-"]').innerText.trim();
                const subtotal = row.querySelector('td:nth-child(4)').innerText.trim();

                message += `🎸 ${product}\n`;
                message += `Cantidad: ${quantity}\n`;
                message += `Precio: ${price}\n`;
                message += `Subtotal: ${subtotal}\n\n`;

            });

            const total = document.getElementById('cart-total').innerText.trim();

            message += `💰 Total del pedido: ${total}\n\n`;
            message += "Quedo atento(a) a su cotización. ¡Muchas gracias!";

            const phone = "{{ config('services.whatsapp.phone') }}";

            const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

            window.open(url, '_blank');
        });
    </script>
@endsection