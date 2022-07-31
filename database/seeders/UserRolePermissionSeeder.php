<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //truncate tables
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        Permission::truncate();
        Role::truncate();

        // user admin
        $userAdmin = User::where('email', 'admin@admin.com')->first();
        if ($userAdmin) {
            $userAdmin->delete();
        }
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        //Rol admin
        $rolAdmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin_user',
            'description' => 'Administrator',
            'full_access' => Role::FULL_ACCESS_YES,
        ]);

        //rol Registered User
        $rolUser = Role::create([
            'name' => 'Registered User',
            'slug' => 'registered_user',
            'description' => 'Registered User',
            'full_access' => Role::FULL_ACCESS_NO,
        ]);

        //role_user table
        $userAdmin->roles()->sync([$rolAdmin->id]);

        //Permissions
        $permission_all = [];

        //permission role
        $permission = Permission::create([
            'name' => 'List role',
            'slug' => Permission::ROLE_INDEX_SLUG,
            'description' => 'An user can list role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show role',
            'slug' => Permission::ROLE_SHOW_SLUG,
            'description' => 'An user can see role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Create role',
            'slug' => Permission::ROLE_CREATE_SLUG,
            'description' => 'An user can create role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit role',
            'slug' => Permission::ROLE_EDIT_SLUG,
            'description' => 'An user can edit role',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy role',
            'slug' => Permission::ROLE_DELETE_SLUG,
            'description' => 'An user can destroy role',
        ]);

        $permission_all[] = $permission->id;


        //permission user
        $permission = Permission::create([
            'name' => 'List user',
            'slug' => Permission::USER_INDEX_SLUG,
            'description' => 'An user can list user',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Create User',
            'slug' => Permission::USER_CREATE_SLUG,
            'description' => 'An user can create user',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show user',
            'slug' => Permission::USER_SHOW_SLUG,
            'description' => 'An user can see user',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit user',
            'slug' => Permission::USER_EDIT_SLUG,
            'description' => 'An user can edit user',
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy user',
            'slug' => Permission::USER_DESTROY_SLUG,
            'description' => 'An user can destroy user',
        ]);

        $permission_all[] = $permission->id;
    }
}
