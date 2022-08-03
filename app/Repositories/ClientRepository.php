<?php

namespace App\Repositories;

use App\Http\Requests\ClientRequest;
use App\Interfaces\ClientInterface;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Throwable;

class ClientRepository implements ClientInterface
{
    /**
     * @var Client
     */
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllClients($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 10): array
    {
        try {
            $clients = $this->client
                ->where('name', 'LIKE', "%$filter%")
                ->orWhere('email', 'LIKE', "%$filter%")
                ->orWhere('identification')
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage, $columns);
            return [
                "err" => false,
                "message" => "All Clients",
                "content" => $clients
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    public function getClientById($id): array
    {
        try {
            $client = $this->client->findOrFail($id);
            return [
                "err" => false,
                "message" => "Client Found!",
                "content" => $client
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
    public function requestClient(ClientRequest $request, $id = null): array
    {
        DB::beginTransaction();
        try {
            // If client exists when we find it
            // Then update the client
            // Else create the new one.

            $client = $id ? $this->client->findOrFail($id) : new Client;
            $client->identification = $request->identification;
            $client->name = $request->name;
            $client->address = $request->address;
            $client->phone_number = $request->phone_number;
            // Remove a whitespace and make to lowercase
            $client->email = preg_replace('/\s+/', '', strtolower($request->email));

            // Save the user
            $client->save();

            DB::commit();
            return [
                "err" => false,
                "message" => $id ? "Client updated successfully" : "Client created successfully",
                "content" => $client
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
    public function deleteClient($id): array
    {
        DB::beginTransaction();
        try {
            $client = $this->client->findOrFail($id);

            // Delete the client
            $client->delete();

            DB::commit();
            return [
                "err" => false,
                "message" => "Client deleted successfully",
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
