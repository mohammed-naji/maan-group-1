<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 10) as $i) {
            // Post::create([
            //     'title_en' => 'Title ' . $i,
            //     'title_ar' => 'عنوان ' . $i,
            //     'content_en' => 'Content ' . $i,
            //     'content_ar' => 'محتوى ' . $i,
            // ]);

            Post::create([
                'title' => json_encode(['en' => 'Title ' . $i, 'ar' => 'عنوان ' . $i]),
                'content' => json_encode(['en' => 'Content ' . $i, 'ar' => 'محتوى ' . $i]),
            ]);
        }
    }
}
