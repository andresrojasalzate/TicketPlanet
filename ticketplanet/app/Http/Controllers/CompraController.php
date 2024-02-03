<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CompraController extends Controller
{
    public function generarPdfEntradas()
    {

        $qr = QrCode::size(100)
            ->format('png')
            ->generate('https://laravel.com');

        $pdf = Pdf::loadView('pdfs.entrada', ['qr' => $qr]);
        return $pdf->stream();
    }

    public function mostrarCompra(Request $request)
    {
        return view('compra.compra');
    }
}
