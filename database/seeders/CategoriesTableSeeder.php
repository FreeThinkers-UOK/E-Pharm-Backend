<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_name'        => 'General Sales List',

        ]);
        Category::create([
            'category_name'        => 'Pharmacy Medicines',

        ]);
        Category::create([
            'category_name'        => 'Prescription Medicines',

        ]);
        Category::create([
            'category_name'        => 'Controlled Drugs',

        ]);
    }
    
}
