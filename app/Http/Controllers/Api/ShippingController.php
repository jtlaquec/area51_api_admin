<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use App\Http\Resources\Api\ShippingResource;
use App\Http\Resources\Api\ShippingMethodResource;

class ShippingController extends Controller
{
    public function listarMetodosEnvio(Request $request)
    {
        try {
            $shipping_methods = ShippingMethod::get();

            return ShippingMethodResource::collection($shipping_methods);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de metodos de envío. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function crearEnvio(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'shipping_method_id' => 'required|exists:shipping_methods,id',
                'district_id' => 'required|exists:districts,id',
            ]);


            $shipping = new Shipping();

            if($validatedData['shipping_method_id'] == 1) {
                $shipping->cost = 0;
                $shipping->district_id = null;
            } else {
                $district = District::findOrFail($validatedData['district_id']);
                $shipping->cost = $district->shipping_cost;
                $shipping->district_id = $validatedData['district_id'];
            }

            $shipping->order_id = $validatedData['order_id'];
            $shipping->shipping_method_id = $validatedData['shipping_method_id'];
            $shipping->shipping_datetime = Date::now();
            $shipping->estimated_delivery_date = Date::now();
            $shipping->shipping_number = null;
            $shipping->shipping_code = null;
            $shipping->notes = null;
            $shipping->save();
            $shippingResource = new ShippingResource($shipping);

            return response()->json(['message' => 'Envío creado exitosamente.', 'shipping' => $shippingResource], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el envío. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function verEnvio($id)
    {
        $shipping = Shipping::find($id);

        if ($shipping) {
            return new ShippingResource($shipping);
        } else {
            return response()->json(['message' => 'Envio no encontrado'], 404);
        }
    }


    public function editarEnvio(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'order_id' => 'sometimes|exists:orders,id',
                'shipping_method_id' => 'sometimes|exists:shipping_methods,id',
                'district_id' => 'sometimes|exists:districts,id',
            ]);

            $shipping = Shipping::findOrFail($id);

            if($validatedData['shipping_method_id'] == 1) {
                $shipping->cost = 0;
                $shipping->district_id = null;
            } else {
                $district = District::findOrFail($validatedData['district_id']);
                $shipping->cost = $district->shipping_cost;
                $shipping->district_id = $validatedData['district_id'];
            }

            $shipping->order_id = $validatedData['order_id'];
            $shipping->shipping_method_id = $validatedData['shipping_method_id'];
            $shipping->save();

            $shippingResource = new ShippingResource($shipping);

            return response()->json(['message' => 'Envío actualizado exitosamente.', 'shipping' => $shippingResource], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el envío. Detalles: ' . $e->getMessage()], 500);
        }
    }


}
