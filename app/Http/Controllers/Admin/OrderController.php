<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
/*         $orders = Order::with('user', 'state',)->orderBy('state_id', 'asc')
            ->paginate(10); */
        return view('admin.orders.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order = Order::with(
            'order_details',

            'user',

            'payment_detail',
            'payment_detail.payment',
            'payment_detail.payment.payment_method',


            'shipping',
            'shipping.shipping_method',
            'shipping.district',


            'order_details.product_variant',
            'order_details.product_variant.color',
            'order_details.product_variant.size'



        )->findOrFail($order->id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
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
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Bien hecho!',
                'text' => 'Orden eliminada correctamente.',
            ]);

            return redirect()->route('admin.orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => 'Error al eliminar la orden.',
            ]);
        }
    }
}
