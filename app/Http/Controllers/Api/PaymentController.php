<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Api\PaymentDetailResource;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'payment_id' => 'required|exists:payments,id',
                'order_id' => 'required|exists:orders,id',
                'boucher' => 'required|image',
                'date' => 'required|date',
            ]);

            $order = Order::find($validatedData['order_id']);
            $shipping = Shipping::where('order_id', $validatedData['order_id'])->first();

            if(!$order || !$shipping){
                return response()->json(['message' => 'Orden o envío no encontrados'], 404);
            }

            $totalPay = $order->total + $shipping->cost;
            $validatedData['pay'] = $totalPay;

            $validatedData['payment_state_id'] = 1;

            if ($request->hasFile('boucher')) {
                $path = $request->file('boucher')->store('payments', 'public');
                $validatedData['image_path'] = $path;
            }

            $paymentDetail = PaymentDetail::create($validatedData);

            if ($paymentDetail) {
                return response()->json([
                    'data' => new PaymentDetailResource($paymentDetail),
                    'message' => 'El pago se generó correctamente, espere la confirmación de pago.'
                ], 201);
            } else {
                return response()->json(['message' => 'Fallo al momento de crear pago'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al procesar el pago: ' . $e->getMessage()], 500);
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

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'payment_id' => 'sometimes|exists:payments,id',
                'boucher' => 'sometimes|image',
                'date' => 'sometimes|date',
            ]);

            $paymentDetail = PaymentDetail::find($id);

            if (!$paymentDetail) {
                return response()->json(['message' => 'Detalle de pago no encontrado'], 404);
            }

            if ($request->hasFile('boucher')) {
                if ($paymentDetail->image_path && Storage::disk('public')->exists($paymentDetail->image_path)) {
                    Storage::disk('public')->delete($paymentDetail->image_path);
                }

                $path = $request->file('boucher')->store('payments', 'public');
                $validatedData['image_path'] = $path;
            }

            $paymentDetail->update($validatedData);

            return response()->json([
                'data' => new PaymentDetailResource($paymentDetail),
                'message' => 'El pago ha sido actualizado correctamente.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el pago: ' . $e->getMessage()], 500);
        }
    }
}
