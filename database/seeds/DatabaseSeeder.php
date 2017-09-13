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
        //
        for($i=0; $i < 50; $i++){
            DB::table('product')->insert([
                'product_name' => str_random(10),
                'product_price' => str_random(10).'@gmail.com',
                'product_description' => bcrypt('secret'),
                'product_status' => rand(0,1),
                'created_at' => date,
                'updated_at' => rand(0,1),
            ]);
        }
    }
}
