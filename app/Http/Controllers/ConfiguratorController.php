<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Pickup;


use App\Models\ProductStandard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class ConfiguratorController extends Controller
{
    public function index($id)
    {
        // Traer el producto
        $product = ProductStandard::findOrFail($id);
        $pickups = Pickup::select('name', 'value', 'product_type', 'additional')
            ->get()
            ->filter(function ($pickup) use ($product) {
                $types = json_decode($pickup->product_type, true);

                if (!is_array($types))
                    return false;
                return in_array($product->code, $types);
            })
            ->values();

        $colors = Color::where('product_type', $product->code)
            ->get(['name', 'value', 'images']);

        $whatsapp = config('services.whatsapp.phone');

        return view('building-guitar.index', compact('colors', 'pickups', 'product', 'whatsapp'));
    }

}
