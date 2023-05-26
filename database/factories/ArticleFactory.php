<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory{
    // ...

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic_id' => Topic::factory()->create()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}

