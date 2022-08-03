<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Interfaces\ClientInterface;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected ClientInterface $clientInterface;

    public function __construct(ClientInterface $clientInterface)
    {
        $this->clientInterface = $clientInterface;
    }

    public function index(Request $request)
    {
        $filter = $request->get('filter');
        $clientsResponse = $this->clientInterface->getAllClients($filter);
        if (!$clientsResponse['err']) {
            return view('client.index', [
                "clients" => $clientsResponse["content"]
            ]);
        } else {
            dd("Error", $clientsResponse["message"]);
        }
    }

    public function create(): View
    {
        $client = new Client;
        return view('client.form', compact('client'));
    }

    public function store(ClientRequest $request): View|RedirectResponse
    {
        $response = $this->clientInterface->requestClient($request);
        if (!$response['err']) {
            return redirect()->route('client.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('client.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function show(int $id)
    {
        $clientResponse = $this->clientInterface->getClientById($id);
        if (!$clientResponse['err']) {
            return view('client.show', [
                "client" => $clientResponse["content"]
            ]);
        } else {
            dd("Error");
        }
    }

    public function edit(int $id)
    {
        $clientResponse = $this->clientInterface->getClientById($id);
        if (!$clientResponse['err']) {
            return view('client.form', [
                "client" => $clientResponse["content"],
            ]);
        } else {
            dd("Error");
        }
    }

    public function update(ClientRequest $request, int $id):View|RedirectResponse
    {
        $response = $this->clientInterface->requestClient($request, $id);
        if (!$response['err']) {
            return redirect()->route('client.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('client.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $response = $this->clientInterface->deleteClient($id);
        if (!$response['err']) {
            return redirect()->route('client.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('client.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }
}
