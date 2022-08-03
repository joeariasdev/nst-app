<?php

namespace App\Interfaces;

use App\Http\Requests\ClientRequest;

interface ClientInterface
{
    public function getAllClients($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 25);

    public function getClientById(int $id);

    public function requestClient(ClientRequest $request, int $id = null);

    public function deleteClient(int $id);
}
