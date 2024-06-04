<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Line;
use Auth;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Muestra todas las facturas del usuario autenticado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function mostrarFacturas()
    {
        $facturas = Invoice::where('user_id', Auth::id())->get();

        return view('facturas', ['facturas' => $facturas]);
    }

    /**
     * Muestra los detalles de una factura específica del usuario autenticado.
     *
     * @param  int  $invoice_id
     * @return \Illuminate\Contracts\View\View
     */
    public function detallesFactura($invoice_id)
    {
        $factura = Invoice::where('user_id', Auth::id())->findOrFail($invoice_id);
        
        $lineas = Line::where('invoice_id', $invoice_id)->with('product')->get();
        
        $facturas = Invoice::where('user_id', Auth::id())->get();
        
        return view('facturas', ['facturas' => $facturas, 'factura' => $factura, 'lineas' => $lineas]);
    }


    /**
     * Descarga el PDF de una factura específica del usuario autenticado.
     *
     * @param  int  $invoice_id
     * @return \Illuminate\Http\Response
     */
    public function descargarPDF($invoice_id) 
    {
        $factura = Invoice::findOrFail($invoice_id);
        $user = Auth::user(); 
        
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $factura, 'user' => $user]);
        
        return $pdf->download('invoice.pdf');
    }
}
