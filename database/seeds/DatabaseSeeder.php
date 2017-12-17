<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
    }

}
class UsersTableSeeder extends Seeder
{
    //thêm dữ liệu của bảng users tự tạo
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //tao bang xem tren document 
        DB::table('users')->insert(['name' =>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make(123456),
            'quyen'=>'1' 
        ]);
    }
}