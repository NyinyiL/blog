<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate() ;
        // Category::truncate() ;
        // Blog::truncate() ;

        // $hello = Category::factory()->create(['name' => "Hello this is frontend"]) ;
        // $new = Category::factory()->create(['name' => "New this is backend"]) ;


        // User::factory(1)->create();
        // Blog::factory(2)->create(['category_id' => $hello->id]) ;
        // Blog::factory(2)->create(['category_id' => $new->id]) ;


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $mgmg = User::factory()->create(['name' => "mgmg" , "username" => "mgmg"]) ;
        $aungaung = User::factory()->create(["name" => "aungaung", "username" => "aungaung"]) ;
        $frontend = Category::factory()->create(["name" => "frontend", "slug" => "frontend"]) ;
        $backend = Category::factory()->create(['name' => "backend" , "slug" => "backend"]) ;

        Blog::factory(2)->create(["category_id" => $frontend->id, 'user_id' => $mgmg->id]) ;
        Blog::factory(2)->create(["category_id" => $backend->id, 'user_id' => $aungaung->id]) ;

       
    }
}
