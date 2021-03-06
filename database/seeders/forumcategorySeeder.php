<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class forumcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_categorys')->insert(
            [
                'category_names' => 'General Discussion',                
            ]
        );
        DB::table('forum_categorys')->insert(
            [
                'category_names' => 'Schools',                
            ]
        );
        DB::table('forum_categorys')->insert(
            [
                'category_names' => 'Administration',                
            ]
        );
        DB::table('forum_categorys')->insert(
            [
                'category_names' => 'Technology',                
            ]
        );
        DB::table('forum_categorys')->insert(
            [
                'category_names' => 'Professional Practice',                
            ]
        );
    }
}
