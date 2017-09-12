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
        DB::table('product')->insert([
            'product_name' => str_random(10),
            'product_price' => str_random(10),
            'product_description' => str_random(10),
            'product_status' => rand(0,1),
            'product_time_created' => date('Y-m-d h:i:s'),
            'product_time_updated' => date('Y-m-d h:i:s'),
        ]);
    }
}
