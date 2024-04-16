<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Line;
use Auth;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function mostrarFacturas()
    {
        // Obtener todas las facturas del usuario logueado
        $facturas = Invoice::where('user_id', Auth::id())->get();

        // Pasar los datos a la vista facturas.blade.php
        return view('facturas', ['facturas' => $facturas]);
    }

    public function detallesFactura($invoice_id)
    {
        // Obtener la factura específica del usuario logueado
        $factura = Invoice::where('user_id', Auth::id())->findOrFail($invoice_id);
        
        // Obtener las líneas asociadas a esta factura con los productos relacionados
        $lineas = Line::where('invoice_id', $invoice_id)->with('product')->get();
        
        // Obtener todas las facturas del usuario logueado
        $facturas = Invoice::where('user_id', Auth::id())->get();
        
        // Pasar los datos a la vista facturas.blade.php con los detalles de la factura
        return view('facturas', ['facturas' => $facturas, 'factura' => $factura, 'lineas' => $lineas]);
    }

    public function descargarPDF($invoice_id) {
        // Lógica para obtener los datos de la factura y el usuario
        $factura = Invoice::findOrFail($invoice_id);
        $user = Auth::user(); // Obtiene los datos del usuario autenticado
        
        // Genera el PDF con los datos de la factura y el usuario
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $factura, 'user' => $user]);
        
        return $pdf->download('invoice.pdf');
    }
}
