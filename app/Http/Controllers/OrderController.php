<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderNo = request("order_no");
        $start = request("start");
        $end = request("end");

        $orders = Order::when($orderNo, fn($query) => $query->where("order_no", "like", "%" . $orderNo . "%"))
            ->when($start, fn($query) => $query->whereDate("order_date", ">=", $start))
            ->when($end, fn($query) => $query->whereDate("order_date", "<=", $end))
            ->paginate(10)
            ->withQueryString();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // generate order number
        $orderNo = $this->generateOrderNo();

        try {
            DB::beginTransaction();
            $values = array_merge($request->validated(), ['order_no' => $orderNo]);
            $order = Order::create($values);
            // Attach order products
            $order->orderProducts()->createMany($request->items);
            DB::commit();
            return response()->json(["success" => "Order berhasil ditambahkan!"], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal menyimpan data' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);

        // If the order is not found, return a 404 response
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return new OrderResource($order->load("orderProducts"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        $order = Order::find($id);

        // jika data tidak ditemukan return 404
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        try {
            DB::beginTransaction();
            $order->update($request->validated());
            // Detach existing order products
            $order->orderProducts()->delete();
            // Attach new order products
            $order->orderProducts()->createMany($request->items);

            DB::commit();
            return response()->json(["success" => "Order berhasil diupdate"], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update order' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        // jika data tidak ditemukan return 404
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        try {
            DB::beginTransaction();
            $order->orderProducts()->delete();
            $order->delete();
            DB::commit();
            return response()->json(["success" => "order berhasil dihapus"], 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete order' . $e->getMessage()], 500);
        }
    }

    private function generateOrderNo(): string
    {
        $today = date('Ymd');
        $sequence = str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT);
        return 'INV' . $today . $sequence;
    }
}
