<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Interfaces\DeviceInterface;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    protected DeviceInterface $deviceInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(DeviceInterface $deviceInterface)
    {
        $this->deviceInterface = $deviceInterface;
    }

    public function index(Request $request): View
    {
        $filter = $request->get('filter');
        $devices = $this->deviceInterface->getAllDevices($filter);
        if (!$devices['err']) {
            return view('device.index', [
                "devices" => $devices["content"]
            ]);
        } else {
            return view('errors.500');
        }
    }

    public function create(): View
    {
        $device = new Device;
        $clients = Client::pluck('name', 'id');
        return view('device.form', compact('device', 'clients'));
    }

    public function store(DeviceRequest $request): RedirectResponse
    {
        $response = $this->deviceInterface->requestDevice($request);
        if (!$response['err']) {
            return redirect()->route('device.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('device.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function show(int $id)
    {
        $device = $this->deviceInterface->getDeviceById($id);
        if (!$device['err']) {
            return view('device.show', [
                "device" => $device["content"]
            ]);
        } else {
            dd("Error");
        }
    }

    public function edit(int $id): View
    {
        $device = $this->deviceInterface->getDeviceById($id);
        $clients = Client::pluck('name', 'id');
        if (!$device['err']) {
            return view('device.form', [
                "device" => $device["content"],
                "clients" => $clients
            ]);
        } else {
            dd("Error");
        }
    }

    public function update(DeviceRequest $request, int $id): View|RedirectResponse
    {
        $response = $this->deviceInterface->requestDevice($request, $id);
        if (!$response['err']) {
            return redirect()->route('device.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('device.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function destroy(int $id)
    {
        $response = $this->deviceInterface->deleteDevice($id);
        if (!$response['err']) {
            return redirect()->route('device.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('device.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }
}
