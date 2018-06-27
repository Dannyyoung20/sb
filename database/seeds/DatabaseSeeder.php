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
        // $this->call(UsersTableSeeder::class);
        factory(App\Models\User::class, 20)->create();
        factory(App\Models\Location::class, 20)->create();
        factory(App\Models\Category::class, 10)->create();
        factory(App\Models\Course::class, 20)->create();
        factory(App\Models\Tutor::class, 20)->create();
        factory(App\Models\Role::class, 3)->create();
        
    }
}
