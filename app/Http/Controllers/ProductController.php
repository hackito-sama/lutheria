<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Log;

class ProductController extends Controller
{

    public function show($id)
    {
        $product = Product::select(
            'id',
            'name',
            'description',
            'price',
            'stock',
            'images',
            'specifications'
        )->where('id', $id)->first();

        $specifications = json_decode($product->specifications, true);
        $fichaTecnica = $specifications['ficha_tecnica_y_dimensiones'] ?? [];

        // 🔑 Obtén el número desde config
        $whatsapp = config('services.whatsapp.phone');

        // Pasa también el número a la vista
        return view('products.details', compact('product', 'fichaTecnica', 'whatsapp'));
    }

}
