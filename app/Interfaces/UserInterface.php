<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterface
{
    public function getAllUsers($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 25);

    public function getUserById(int $id);

    public function requestUser(UserRequest $request, int $id = null);

    public function deleteUser(int $id);
}
