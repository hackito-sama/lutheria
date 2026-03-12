<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'type' => 'required'
        ]);

        // Guardar en la tabla (suponiendo que tienes un modelo Contact)
        Quotation::create([
            'client' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'details' => $request->message,
        ]);

        $message = "Nuevo contacto:\n" .
            "Nombre: {$request->name}\n" .
            "Email: {$request->email}\n" .
            "Teléfono: {$request->phone}\n" .
            "Tipo: {$request->type}\n" .
            "Mensaje: {$request->message}";

        // Número desde config/services.php 
        $phone = config('services.whatsapp.phone');
        // Redirigir a WhatsApp 
        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        // Redirigir con mensaje de éxito
        return response()->json([
            'status' => 'success',
            'urlwsp' => $url,
            'message' => 'Formulario enviado correctamente. Será respondido apenas sea posible.'
        ]);
    }
}
