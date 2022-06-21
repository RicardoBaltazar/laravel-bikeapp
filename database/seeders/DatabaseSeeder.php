<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//execute seeder = php artisan db:seed
//remove all = php artisan db:wipe
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductsSeeder::class);
    }
}
