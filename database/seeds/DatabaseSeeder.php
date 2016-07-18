<?php

use Illuminate\Database\Seeder;
use App\User;

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
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create();
        for($i=3;$i<20;$i++){
          User::create([
              'name' => $faker->unique()->name,
              'email' => $faker->unique()->email,
              'password' => bcrypt('123456'),
              'address' => $faker->address,
              'gender' => $faker->randomElement($array = array ('male', 'female')),
            ]);
        }
    }
}