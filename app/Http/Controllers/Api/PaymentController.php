<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PaymentDetailResource;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'order_id' => 'required|exists:orders,id',
            'boucher' => 'required|image',
            'date' => 'required|date',
            'pay' => 'required|numeric',
        ]);

        $validatedData['payment_state_id'] = 1;

        if ($request->hasFile('boucher')) {
            $path = $request->file('boucher')->store('payments', 'public');
            $validatedData['image_path'] = $path;
        }

        $paymentDetail = PaymentDetail::create($validatedData);

        if ($paymentDetail) {
            return new PaymentDetailResource($paymentDetail);
        } else {
            return response()->json(['message' => 'Fallo al momento de crear pago'], 500);
        }
    }

    public function show($id)
    {
        $paymentDetail = PaymentDetail::find($id);

        if ($paymentDetail) {
            return new PaymentDetailResource($paymentDetail);
        } else {
            return response()->json(['message' => 'Detalle de pago no encontrado'], 404);
        }
    }
}
