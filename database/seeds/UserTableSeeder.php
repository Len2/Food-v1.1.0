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
        $user = User::updateOrCreate([
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::updateOrCreate(['name' => 'Admin']);

        $permissions = Permission::where('guard_name','=','web')->pluck('id','id');

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
