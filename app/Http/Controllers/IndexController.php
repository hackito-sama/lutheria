<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStandard;
use App\Models\SiteImage;
use Log;

class IndexController extends Controller
{
    public function sliders()
    {
        $sliders = SiteImage::select('url')->where('active', 1)->get();
        $products_standard = ProductStandard::select(
            'id',
            'name',
            'price',
            'images',
            'description'
            )
            ->where('flg', 1)
            ->get();

        $products = Product::select('id', 'name', 'price', 'images', 'stock')->where('flg_index', 1)->get();
        return view('index', compact('sliders', 'products', 'products_standard'));

    }
}
