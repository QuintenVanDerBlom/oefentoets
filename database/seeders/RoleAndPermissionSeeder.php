<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions for category CRUD
        Permission::create(['name' => 'index category']);
        Permission::create(['name' => 'show category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        // permissions for product CRUD
        Permission::create(['name' => 'index product']);
        Permission::create(['name' => 'show product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        // permissions for order CRUD
        Permission::create(['name' => 'index order']);
        Permission::create(['name' => 'show order']);
        Permission::create(['name' => 'create order']);
        Permission::create(['name' => 'edit order']);
        Permission::create(['name' => 'delete order']);

        // customer role
        $customer = Role::create(['name' => 'customer']);

        // sales role
        $sales = Role::create(['name' => 'sales'])
            ->givePermissionTo(['index category', 'show category', 'create category', 'edit category',
                'index product', 'show product', 'create product',
                'index order', 'show order', 'create order', 'edit order']);

        // admin role
        $admin = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
    }
}

