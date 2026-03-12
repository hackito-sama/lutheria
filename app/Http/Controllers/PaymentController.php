<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);

        return view('payment.index', compact('cartItems'));
    }
}
