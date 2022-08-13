<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
             'is_admin'=>'1',
            'password'=> bcrypt('1234'),
         ],
         [
            'name'=>'User',
            'email'=>'user@user.com',
             'is_admin'=>'0',
            'password'=> bcrypt('1234'),
         ],);
        
  
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
