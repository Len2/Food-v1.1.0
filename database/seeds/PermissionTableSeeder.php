<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'page-list',
            'page-create',
            'page-edit',
            'page-delete',

            'task-list',
            'task-create',
            'task-edit',
            'task-delete',

            'list-task-list',
            'task-list-create',
            'task-list-edit',
            'task-list-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'order-list',
            'order-single',

            'cart-list',
            'cart-edit',

            'gallery-list',
            'gallery-create',
            'gallery-delete',

            'invoice-list',
            'invoice-create',
            'invoice-update',
            'invoice-delete',
            'invoice-single',

            'reservation-list',
           // 'reservation-create',
            'reservation-update',
            'reservation-delete',
            'reservation-single',

        ];

        $permissionsGuard = [
            'driver-list'
        ];



        Permission::where('id', 'like' ,'%%')->delete();
        DB::statement("ALTER TABLE permissions AUTO_INCREMENT = 1;");

        foreach ($permissions as $permission) {
            Permission::create([
                    'name' => $permission,
                    'guard_name' =>'web' // 'guard_name' =>'...'
                ]);
        }

        foreach ($permissionsGuard as $p) {
            Permission::create([
                'name' => $p,
                'guard_name' =>'user_pages' // 'guard_name' =>'...'
            ]);
        }
    }
}
