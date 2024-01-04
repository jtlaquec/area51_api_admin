<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OrderResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $orders = Order::with('order_details','state')->get();
            return OrderResource::collection($orders);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de órdenes. Detalles: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validamos los datos ingresados
            $validatedData = $this->validateOrder($request);

            // Calculamos el total
            $total = $this->calculateTotal($validatedData['items']);

            // Creamos la orden
            $order = Order::create([
                'user_id' => $validatedData['user_id'],
                'datetime' => now(),
                'total' => $total,
                'state_id' => 1,
                'reason' => "Por la compra según Boleta de Venta N°... (falta)",
                'shipping_address' => 'Recojo en tienda',
            ]);

            // Agregamos los detalles de la orden
            $this->createOrderDetails($order, $validatedData['items']);

            $order->load('order_details','state');

            DB::commit();

            $message = 'Orden creada con éxito.';
            return response()->json(['data' => new OrderResource($order), 'message' => $message], 201);

            /* return response()->json(['message' => 'Orden creada satisfactoriamente', 'order_id' => $order->id]); */
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => 'No se puede encontrar el elemento especificado. Detalles: ' . $e->getMessage()], 404);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error en la validación de datos. Detalles: ' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear la orden. Detalles: ' . $e->getMessage()], 500);
        }
    }

    private function validateOrder($request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.product_variant_id' => 'required|exists:product_variants,id',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);
    }

    private function calculateTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function createOrderDetails($order, $items)
    {
        foreach ($items as $item) {
            $productVariant = ProductVariant::find($item['product_variant_id']);

            if ($productVariant && $productVariant->stock >= $item['quantity']) {
                // Actualizamos el stock
                $productVariant->stock -= $item['quantity'];
                $productVariant->save();

                // Creamos el detalle de la orden
                $order->order_details()->create([
                    'product_variant_id' => $item['product_variant_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ]);
            } else {
                throw new \Exception("Stock insuficiente o Producto no encontrado");
            }
        }
    }

    public function show($id)
    {
        try {

            $order = Order::with('order_details','state')->findOrFail($id);

            return new OrderResource($order);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Orden no encontrada. Detalles: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos de la orden. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function listarOrdenesPorCliente($userId)
    {
        try {
            $orders = Order::with('order_details','state')->where('user_id', $userId)->get();

            return OrderResource::collection($orders);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de órdenes del usuario. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $orderDetails = $order->order_details;

            // Actualizamos el stock para cada producto variante
            foreach ($orderDetails as $detail) {
                $productVariant = ProductVariant::find($detail->product_variant_id);
                if ($productVariant) {
                    $productVariant->stock += $detail->quantity;
                    $productVariant->save();
                }
            }

            $order->delete();

            DB::commit();
            return response()->json(['message' => 'Orden eliminada con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar la orden. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
