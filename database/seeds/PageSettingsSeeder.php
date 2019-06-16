<?php

use Illuminate\Database\Seeder;

class PageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('page_settings')->insert([
        	'key' => 'title',
        	'value' => 'Website Name'
        ]);

        \DB::table('page_settings')->insert([
        	'key' => 'keywords',
        	'value' => ''
        ]);

        \DB::table('page_settings')->insert([
        	'key' => 'description',
        	'value' => ''
        ]);

        \DB::table('page_settings')->insert([
            'key' => 'social_facebook_link',
            'value' => ''
        ]);

        \DB::table('page_settings')->insert([
            'key' => 'social_youtube_link',
            'value' => ''
        ]);

        \DB::table('page_settings')->insert([
            'key' => 'paypal_min_amount',
            'value' => 0
        ]);

        \DB::table('page_settings')->insert([
            'key' => 'paypal_discount',
            'value' => 0
        ]);
    }
}
