<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        // Calcular el total del carrito
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        return view('cart.index', compact('cartItems', 'total'));
    }


    public function add(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $quantity = (int) $request->quantity; // <--- importante
        $image = $request->image ?? '';

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity; // sumar la cantidad
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image,
                'stock' => $request->stock ?? 999,
            ];
        }

        session()->put('cart', $cart);

        // calcular cantidad total del carrito
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
            'message' => "Producto agregado correctamente"
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
