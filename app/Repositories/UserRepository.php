<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository implements UserInterface
{
    /**
     * @var User
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers($filter, $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', $perPage = 10): array
    {
        try {
            $users = $this->user
                ->with([
                    'roles',
                ])
                ->where('name', 'LIKE', "%$filter%")
                ->orWhere('email', 'LIKE', "%$filter%")
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage, $columns);
            return [
                "err" => false,
                "message" => "All Users",
                "content" => $users
            ];
        } catch (\Exception $e) {
            return [
                "err" => true,
                "message" => $e->getMessage(),
                "content" => []
            ];
        }
    }

    public function getUserById($id): array
    {
        try {
            $user = $this->user
                ->with([
                    'roles',
                ])->findOrFail($id);
            return [
                "err" => false,
                "message" => "All Users",
                "content" => $user
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
    public function requestUser(UserRequest $request, $id = null): array
    {
        DB::beginTransaction();
        try {
            // If user exists when we find it
            // Then update the user
            // Else create the new one.

            $user = $id ? $this->user->findOrFail($id) : new User;
            $user->name = $request->name;
            // Remove a whitespace and make to lowercase
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));
            $user->password = Hash::make($request->password);

            // Save the user
            $user->save();

            //Adding user role
            $user->roles()->sync($request->get('role'));

            DB::commit();
            return [
                "err" => false,
                "message" => $id ? "User updated successfully" : "User created successfully",
                "content" => $user
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
    public function deleteUser($id): array
    {
        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);

            // Delete the user
            $user->delete();

            $user->roles()->sync([]);

            DB::commit();
            return [
                "err" => false,
                "message" => "User deleted successfully",
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
