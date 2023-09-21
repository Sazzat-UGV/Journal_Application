<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //create Admin
        $adminRoleId=Role::where('role_slug','admin')->first()->id;
        $name='Shahrier Sanjid Mehedi';
        User::updateOrCreate([
            'role_id'=>$adminRoleId,
            'name'=>$name,
            'slug'=>Str::slug($name),
            'email'=>'admin@gmail.com',
            'phone'=>'01710101010',
            'email_verified_at'=>now(),
            'password'=>Hash::make('admin@gmail.com'),
            'is_modifiable'=>false,
            'remember_token'=>Str::random(10),
        ]);

        // $name1='Tariqul Islam';
        // User::updateOrCreate([
        //     'role_id'=>$adminRoleId,
        //     'name'=>$name1,
        //     'slug'=>Str::slug($name1),
        //     'email'=>'tariqulislam@gmail.com',
        //     'phone'=>'01842733104',
        //     'user_image'=>'default_user.jpg',
        //     'email_verified_at'=>now(),
        //     'password'=>Hash::make(12011016),
        //     'is_modifiable'=>false,
        //     'remember_token'=>Str::random(10),
        // ]);


        //create Manager
        $managerRoleId=Role::where('role_slug','manager')->first()->id;
        $manager='Manager';
        User::updateOrCreate([
            'role_id'=>$managerRoleId,
            'name'=>$manager,
            'slug'=>Str::slug($manager),
            'email'=>'manager@gmail.com',
            'phone'=>'01710101011',
            'email_verified_at'=>now(),
            'password'=>Hash::make('manager@gmail.com'),
            'is_modifiable'=>true,
            'remember_token'=>Str::random(10),
        ]);
    }
}
