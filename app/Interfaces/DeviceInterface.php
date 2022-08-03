<?php

namespace App\Interfaces;

use App\Http\Requests\DeviceRequest;

interface DeviceInterface
{
    public function getAllDevices($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 25);

    public function getDeviceById(int $id);

    public function requestDevice(DeviceRequest $request, int $id = null);

    public function deleteDevice(int $id);
}
