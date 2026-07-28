<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        $phone = config('services.whatsapp.phone');

        return view('cart.index', compact('cartItems', 'total', 'phone'));
    }

    public function add(Request $request)
    {
        $productId = $request->id;
        $variant = $request->variant;

        // Si hay variante, usamos una clave única.
        // Si no, mantenemos el comportamiento antiguo.
        $key = $variant
            ? $productId . '_' . md5($variant)
            : $productId;

        $cart = session()->get('cart', []);

        $quantity = (int) $request->quantity;
        $name = $request->name;
        $price = $request->price;
        $image = $request->image ?? '';

        if (isset($cart[$key])) {

            $cart[$key]['quantity'] += $quantity;

        } else {

            $cart[$key] = [
                'product_id' => $productId,
                'variant' => $variant,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image,
                'stock' => $request->stock ?? 999,
                'options' => $request->options ?? [],
            ];

        }

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
            'message' => 'Producto agregado correctamente'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado del carrito',
                'cartCount' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'El producto no existe en el carrito',
            'cartCount' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }

        $quantity = (int) $request->quantity;
        $stock = $cart[$id]['stock'] ?? 999;

        // Evitar que baje de 1
        if ($quantity < 1) {
            $quantity = 1;
        }

        // Evitar que pase el stock
        if ($quantity > $stock) {
            $quantity = $stock;
        }

        // Guardar
        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);

        $itemTotal = $cart[$id]['price'] * $quantity;
        $cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'message' => 'Cantidad actualizada',
            'quantity' => $quantity,
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount,
        ]);
    }

}
