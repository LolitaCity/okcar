<?php

use Illuminate\Database\Seeder;

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        echo "正在创建管理员账号\n";
        AdminUser::create([
            'name' => 'admin',
            'password' => Hash::make('klxk@123456'),
            'auth' => '123456789',
        ]);
    }
}
