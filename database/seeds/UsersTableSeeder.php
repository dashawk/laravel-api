<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'userID' => \Ramsey\Uuid\Uuid::uuid4(),
            'name' => 'Jason',
            'email' => 'test@email.com',
            'password' => bcrypt('test')
        ]);
    }
}
