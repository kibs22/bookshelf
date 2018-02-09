<?php

use Illuminate\Database\Seeder;

class PostedBooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('posted_books')->insert([
            'seller_id' => 1,
            'availability' => 0,
            'price' => 200.00,
            'description' => 'A book for web junkies',
            'author' => 'Adrian G. Natabio',
            'title' => 'Basics of Web Development',
            'year' => '2017'
        ]);
    }
}
