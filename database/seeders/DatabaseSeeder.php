<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Device;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Subsidiary;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserRolePermissionSeeder::class);
        Subsidiary::factory(5)->create();
        Client::factory(30)->create();
        Device::factory(5)->create();
        Order::factory(20)->create()->each(function ($o){
            OrderDetail::factory(1)->create([
                'order_id' => $o->id,
            ]);
        });
    }
}
