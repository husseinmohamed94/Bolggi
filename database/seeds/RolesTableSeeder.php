<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Factory::create();
        $adminRole = Role::create([
            'name'               => 'admin',
            'display_name'       => 'Administrator',
            'description'        => 'system Administrator',
            'allowed_route'      =>'admin'
        ]);

        $editorRole = Role::create([
            'name'               => 'editor',
            'display_name'       => 'superviser',
            'description'        => 'system superviser',
            'allowed_route'      =>'admin'
        ]);

        $userRole = Role::create([
            'name'               => 'user',
            'display_name'       => 'user',
            'description'        => 'normal user',
            'allowed_route'      =>'null'
        ]);

        $admin = User::create([
            'name'                  =>'Admin',
            'username'              =>'admin',
            'email'                 =>'admin@gmail.com',
            'mobile'                =>'01142805765',
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $admin->attachRole($adminRole);

        $editor = User::create([
            'name'                  =>'editor',
            'username'              =>'editor',
            'email'                 =>'editor@gmail.com',
            'mobile'                =>'01120106527',
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $editor->attachRole($editorRole);

        $user1 = User::create([
            'name'                  =>'hussein mohamed',
            'username'              =>'hussein',
            'email'                 =>'husseinmohmaed@gmail.com',
            'mobile'                =>'01207320779',
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $user1->attachRole($userRole);

        $user2= User::create([
            'name'                  =>'hassan mohamed',
            'username'              =>'hassan',
            'email'                 =>'hassanmohmaed@gmail.com',
            'mobile'                =>'01207340877',
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $user2->attachRole($userRole);

        $user3 = User::create([
            'name'                  =>'ahmed mohamed',
            'username'              =>'ahmed',
            'email'                 =>'ahmedmohmaed@gmail.com',
            'mobile'                =>'01207340009',
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $user3->attachRole($userRole);

            for($i =0; $i<10; $i++){
              
        $user = User::create([
            'name'                  =>  $faker->name,
            'username'              => $faker->userName,
            'email'                 => $faker->email,
            'mobile'                => '9664' . random_int(10000000,99999999),
            'email_verified_at'     =>Carbon::now(),
            'password'              =>bcrypt(123456),
            'status'                =>1,
        ]);
        $user->attachRole($userRole);  
            }
    }
}
