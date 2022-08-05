<?php

namespace App\Interfaces;

use App\Http\Requests\OrderRequest;

interface OrderInterface
{
    public function getAllOrders($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 25);

    public function getOrderById(int $id);

    public function getDevicesByClientId(int $clientId);

    public function requestOrder(OrderRequest $request, int $id);
}
