<?php

namespace App\Repositories;

use App\Http\Requests\OrderRequest;
use App\Interfaces\OrderInterface;
use App\Models\Device;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderRepository implements OrderInterface
{
    /**
     * @var Order
     */
    protected Order $order;
    protected OrderDetail $orderDetail;

    public function __construct(Order $order, OrderDetail $orderDetail)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    public function getAllOrders($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 10): array
    {
        try {
            $orders = $this->order
                ->with([
                    'client' => function ($q) {
                        $q->select('id', 'name');
                    },
                    'subsidiary' => function ($q) {
                        $q->select('id', 'name');
                    }
                ])
                ->distinct()
                ->where('code', 'LIKE', "%$filter%")
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage, $columns);
            return [
                "err" => false,
                "message" => "All Orders",
                "content" => $orders
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    public function getOrderById($id, $lastDetail = false): array
    {
        try {
            $order = $this->order->findOrFail($id);
            $details = new \stdClass();
            if (!$lastDetail) {
                $details = $this->orderDetail->where('order_id', '=', $id)->orderBy('created_at', 'desc')->groupBy('id','order_id')->get();
            }else{
                $details = $this->orderDetail->where('order_id', '=', $id)->orderBy('created_at', 'desc')->first();
            }
            return [
                "err" => false,
                "message" => "Client Found!",
                "content" => $order,
                "details" => $details,
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    public function getDevicesByClientId(int $clientId): array
    {
        try {
            $devices = Device::where('client_id', '=', $clientId)->get();
            return [
                "err" => false,
                "message" => "Devices",
                "content" => $devices
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    public function requestOrder(OrderRequest $request, int $id): array
    {
        DB::beginTransaction();
        try {
            // Adding new order detail

            $order = $this->order->findOrFail($id);
            $orderLastDetail = $this->orderDetail->where('order_id', '=', $id)->latest()->first();
            if($orderLastDetail == OrderDetail::COMPLETE){
                return [
                    "err" => false,
                    "message" => "This order is complete",
                    "content" => $order
                ];
            }
            $newDetail = new OrderDetail;
            $newDetail->order_id = $id;
            $newDetail->device_id = $orderLastDetail->device_id;
            $newDetail->status = $request->status;
            $newDetail->description = $request->description;

            // Save the new detail order
            $newDetail->save();

            DB::commit();
            return [
                "err" => false,
                "message" => "Order Detail Added successfully",
                "content" => $order
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }
}
