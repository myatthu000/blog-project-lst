<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['IT News','Foods','Health and Beauty','Laravel','Django','Cars'];
        foreach ($categories as $category)
        {
            $title = $category;
            Category::factory()->create([
                'title' => $title,
                'slug' => Str::slug($title),
                'user_id' => User::query()->inRandomOrder()->first()->id,
            ]);
        }
    }
}
