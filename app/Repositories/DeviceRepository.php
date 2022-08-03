<?php

namespace App\Repositories;

use App\Http\Requests\DeviceRequest;
use App\Interfaces\DeviceInterface;
use App\Models\Device;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeviceRepository implements DeviceInterface
{
    /**
     * @var Device
     */
    protected Device $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function getAllDevices($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 10): array
    {
        try {
            $devices = $this->device
                ->with([
                    'client' => function ($q) {
                        $q->select('id', 'name');
                    }
                ])
                ->where('serial', 'LIKE', "%$filter%")
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage, $columns);
            return [
                "err" => false,
                "message" => "All Devices",
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

    public function getDeviceById($id): array
    {
        try {
            $device = $this->device->findOrFail($id);
            return [
                "err" => false,
                "message" => "Client Found!",
                "content" => $device
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    /**
     * @throws Throwable
     */
    public function requestDevice(DeviceRequest $request, $id = null): array
    {
        DB::beginTransaction();
        try {
            // If device exists when we find it
            // Then update the device
            // Else create the new one.

            $device = $id ? $this->device->findOrFail($id) : new Device;
            $device->type = $request->type;
            $device->serial = $request->serial;
            $device->description = $request->description;
            $device->client_id = $request->client_id;

            // Save the device
            $device->save();

            DB::commit();
            return [
                "err" => false,
                "message" => $id ? "Device updated successfully" : "Device created successfully",
                "content" => $device
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

    /**
     * @throws Throwable
     */
    public function deleteDevice($id): array
    {
        DB::beginTransaction();
        try {
            $device = $this->device->findOrFail($id);

            // Delete the device
            $device->delete();

            DB::commit();
            return [
                "err" => false,
                "message" => "Device deleted successfully",
                "content" => []
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }
}
