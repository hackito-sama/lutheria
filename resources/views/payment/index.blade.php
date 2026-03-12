@extends('layout.app')

@section('content')
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Finalizar Compra</h2>

            @if(count($cartItems) > 0)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <ul class="mb-6">
                        @foreach($cartItems as $item)
                            <li class="border-b py-2">
                                {{ $item['name'] }} (x{{ $item['quantity'] }}) -
                                ${{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="#" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700">
                        Proceder al pago
                    </a>
                </div>
            @else
                <p class="text-gray-600">Tu carrito está vacío.</p>
            @endif
        </div>
    </section>
@endsection