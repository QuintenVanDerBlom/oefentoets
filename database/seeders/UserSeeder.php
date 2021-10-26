<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create customer
        $customer = User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@tcrmbo.nl',
            'password' => Hash::make('test1234')
        ]);
        $customer->assignRole('customer');

        // create sales account
        $sales = User::factory()->create([
            'name' => 'Sales',
            'email' => 'sales@tcrmbo.nl',
            'password' => Hash::make('test1234')
        ]);
        $sales->assignRole('sales');

        // create admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@tcrmbo.nl',
            'password' => Hash::make('test1234')
        ]);
        $admin->assignRole('admin');
    }
}
