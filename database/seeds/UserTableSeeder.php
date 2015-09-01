<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create(array(
                      'username' => 'admin',
                      'password' => Hash::make('admin'),
                      'nickname' => 'admin',
                      'email' => 'admin@admin.com',
                      'status' => 0,
                      'display_name' => 'jacob Chen',
                    ));
    }

}