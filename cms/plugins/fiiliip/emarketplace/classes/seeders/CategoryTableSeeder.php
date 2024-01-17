<?php namespace Fiiliip\EMarketplace\Classes\Seeders;

use October\Rain\Database\Updates\Seeder;
use Fiiliip\EMarketplace\Models\Category;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'title' => 'Reality',
            'slug' => 'reality'
        ]);

        Category::create([
            'title' => 'Elektronika',
            'slug' => 'elektronika'
        ]);

        Category::create([
            'title' => 'Oblečenie',
            'slug' => 'oblecenie'
        ]);

        Category::create([
            'title' => 'Nábytok',
            'slug' => 'nabytok'
        ]);

        Category::create([
            'title' => 'Dom a záhrada',
            'slug' => 'dom-a-zahrada'
        ]);

        Category::create([
            'title' => 'Hračky',
            'slug' => 'hracky'
        ]);

        Category::create([
            'title' => 'Šport',
            'slug' => 'sport'
        ]);

        Category::create([
            'title' => 'Zvieratá',
            'slug' => 'zvierata'
        ]);

        Category::create([
            'title' => 'Auto',
            'slug' => 'auto'
        ]);

        Category::create([
            'title' => 'Zábava',
            'slug' => 'zabava'
        ]);

        Category::create([
            'title' => 'Ostatné',
            'slug' => 'ostatne'
        ]);
    }
}