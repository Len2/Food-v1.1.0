<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::find(1);
//        $user = User::create([
//            'firstName' => 'Admin',
//            'lastName' => 'Admin',
//            'email' => 'admin@gmail.com',
//            'password' => bcrypt('123456'),
//        ]);

        $role = Role::updateOrCreate(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
