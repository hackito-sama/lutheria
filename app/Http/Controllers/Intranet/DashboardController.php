<?php

namespace App\Http\Controllers\Intranet;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $services = Service::with('owner')->get();
        return view('intranet.dashboard.index', compact('services'));
    }

        public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'owner' => 'required|string|max:255',
            'responsable' => 'required|string|max:255',
            'servicio' => 'required|string|max:255',
            // Agrega más validaciones si necesitas otros campos
        ]);

        // Crear el ticket
        Service::create([
            'owner' => $request->owner,
            'responsable' => $request->responsable,
            'servicio' => $request->servicio,
        ]);

        return redirect()->back()->with('success', 'Ticket creado correctamente');
    }
}
