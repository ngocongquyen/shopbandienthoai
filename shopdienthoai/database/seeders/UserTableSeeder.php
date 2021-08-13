<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();
    
        $admin = Admin::create([
            'admin_name' => 'quyenadmin',
            'admin_email' => 'quyenadmin@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $author = Admin::create([
            'admin_name' => 'QuyenAuthor',
            'admin_email' => 'quyenauthor@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
            'admin_name' => 'quyenuser',
            'admin_email' => 'quyenuser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $user1 = Admin::create([
            'admin_name' => 'thanhuser',
            'admin_email' => 'thanhuser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);
        $user2 = Admin::create([
            'admin_name' => 'hauser',
            'admin_email' => 'hauser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);
        $user3 = Admin::create([
            'admin_name' => 'linhuser',
            'admin_email' => 'linhuser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
        $user1->roles()->attach($userRoles);
        $user2->roles()->attach($userRoles);
        $user3->roles()->attach($userRoles);
    }
}
