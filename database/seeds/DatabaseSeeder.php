<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}

class USersTableSeeder extends Seeder
{
    public function run()
    {
        $user = new \App\User();
        $user->name = 'Administrador';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('admin');
        $user->save();

        /**
         * Cria mais 10 usuários para teste
         */
        // $i = 1;
        // while($i < 11)
        // {
        //     $user = new \App\User();
        //     $user->name = 'User'.$i;
        //     $user->email = 'user'.$i.'@mail.com';
        //     $user->password = bcrypt('user'.$i);
        //     $user->save();
        // }
    }
}
