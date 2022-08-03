<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index(Request $request)
    {
        Gate::authorize('have_access', Permission::USER_INDEX_SLUG);
        $filter = $request->get('filter');
        $users = $this->userInterface->getAllUsers($filter);
        if (!$users['err']) {
            return view('user.index', [
                "users" => $users["content"]
            ]);
        } else {
            dd("Error");
        }
    }

    public function create(): View
    {
        Gate::authorize('have_access', Permission::USER_CREATE_SLUG);
        $user = new User;
        $roles = Role::pluck('name', 'id');
        return view('user.form', compact('user', 'roles'));
    }

    public function store(UserRequest $request): View|RedirectResponse
    {
        Gate::authorize('have_access', Permission::USER_CREATE_SLUG);
        $response = $this->userInterface->requestUser($request);
        if (!$response['err']) {
            return redirect()->route('user.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('user.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function show(int $id)
    {
        Gate::authorize('have_access', Permission::USER_SHOW_SLUG);
        $user = $this->userInterface->getUserById($id);
        if (!$user['err']) {
            return view('user.show', [
                "user" => $user["content"]
            ]);
        } else {
            dd("Error");
        }
    }

    public function edit(int $id)
    {
        Gate::authorize('have_access', Permission::ROLE_EDIT_SLUG);
        $user = $this->userInterface->getUserById($id);
        $roles = Role::pluck('name', 'id');
        if (!$user['err']) {
            return view('user.form', [
                "user" => $user["content"],
                "roles" => $roles
            ]);
        } else {
            dd("Error");
        }
    }

    public function update(UserRequest $request, int $id):View|RedirectResponse
    {
        Gate::authorize('have_access', Permission::USER_EDIT_SLUG);
        $response = $this->userInterface->requestUser($request, $id);
        if (!$response['err']) {
            return redirect()->route('user.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('user.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }

    public function destroy(int $id)
    {
        Gate::authorize('have_access', Permission::USER_DESTROY_SLUG);
        $response = $this->userInterface->deleteUser($id);
        if (!$response['err']) {
            return redirect()->route('user.index')
                ->with('message', ['green-600', 'Success', __($response['message'])]);
        } else {
            return redirect()->route('user.index')
                ->with('message', ['red-600', 'Warning', 'Ups! There was and error']);
        }
    }
}
