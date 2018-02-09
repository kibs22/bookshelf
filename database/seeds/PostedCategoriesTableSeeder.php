<?php

use Illuminate\Database\Seeder;

class PostedCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posted_categories')->insert([
            'posted_id' => 1,
            'created_at' => '2017-8-31',
            'name' => 'bushet'
        ]);
    }
}
