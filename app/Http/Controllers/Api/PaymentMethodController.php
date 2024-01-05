<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    public function listarMetodosPago(Request $request)
    {
        try {
            $payment_methods = PaymentMethod::with('payments')->get();
            return PaymentMethodResource::collection($payment_methods);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de metodos de pago. Detalles: ' . $e->getMessage()], 500);
        }
    }


}
