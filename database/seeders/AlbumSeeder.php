<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 30; $i++) {
            $album = new Album();
            $album->title = $faker->word(3, true);
            $album->genre = $faker->randomElement(array('kpop', 'punk', 'pop', 'grunge', 'hiphop'));
            
            $album->date_released = $faker->date();
            $album->artist_id = $faker->numberBetween(1, 30);
            $album->save();

        }
    }
}
