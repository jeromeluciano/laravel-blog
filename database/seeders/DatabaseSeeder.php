<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);


//        User::query()->truncate();
//        Category::query()->truncate();
//        Post::query()->truncate();
//
//        $user = \App\Models\User::factory()->create();
//
//        $personal = Category::query()->create([
//            'name' => "Personal",
//            'slug' => "personal"
//        ]);
//
//        $work = Category::query()->create([
//            'name' => "Work",
//            'slug' => "work"
//        ]);
//
//        $hobby = Category::query()->create([
//            'name' => "Hobby",
//            'slug' => "hobby"
//        ]);
//
//        Post::query()->create([
//            'user_id' => $user->id,
//            'category_id' => $work->id,
//            'title' => 'My work post',
//            'slug' => 'my-work-post',
//            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, nobis.',
//            'body' => "<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, nobis. </p>"
//        ]);
//        Post::query()->create([
//            'user_id' => $user->id,
//            'category_id' => $personal->id,
//            'title' => 'My personal post',
//            'slug' => 'my-personal-post',
//            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, nobis.',
//            'body' => "<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, nobis. </p>"
//        ]);


    }
}
