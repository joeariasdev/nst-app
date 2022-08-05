<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Interfaces\OrderInterface;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Subsidiary;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderInterface $orderInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function index(Request $request): View
    {
        $filter = $request->get('filter');
        $orders = $this->orderInterface->getAllOrders($filter);
        if (!$orders['err']) {
            return view('order.index', [
                "orders" => $orders["content"]
            ]);
        } else {
            return view('errors.500');
        }
    }

    public function create(int $clientId): View
    {
        $order = new Order;
        $orderDetails = new OrderDetail;
        $devices = $this->orderInterface->getDevicesByClientId($clientId);
        $subsidiaries = Subsidiary::pluck('name', 'id');
        $clients = Client::pluck('name', 'id');
        if (!$devices['err']) {
            return view('order.form', compact(
                    'order',
                    'orderDetails',
                    'subsidiaries',
                    'clients',
                    'devices'
                )
            );
        } else {
            return view('errors.500');
        }
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $response = $this->orderInterface->requestOrder($request);
        if (!$response['err']) {
            return redirect()->route('order.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('order.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function show(int $id): View
    {
        $order = $this->orderInterface->getOrderById($id);
        if (!$order['err']) {
            return view('order.show', [
                "order" => $order["content"],
                "orderDetails" => $order["details"],
            ]);
        } else {
            dd($order);
        }
    }

    public function edit(int $id): View
    {
        $order = $this->orderInterface->getOrderById($id, true);
        $devices = $this->orderInterface->getDevicesByClientId($order["content"]->client_id);
        $subsidiaries = Subsidiary::pluck('name', 'id');
        $clients = Client::pluck('name', 'id');
        if (!$order['err']) {
            return view('order.form', [
                "order" => $order["content"],
                "orderDetail" => $order["details"],
                "clients" => $clients,
                "subsidiaries" => $subsidiaries,
                "devices" => $devices
            ]);
        } else {
            dd("Error");
        }
    }

    public function update(OrderRequest $request, int $id): View|RedirectResponse
    {
        $response = $this->orderInterface->requestOrder($request, $id);
        if (!$response['err']) {
            $order = $this->orderInterface->getOrderById($id);
            return view('order.show', [
                "order" => $order["content"],
                "orderDetails" => $order["details"],
            ]);
        } else {
            return view('errors.500');
        }
    }
}
