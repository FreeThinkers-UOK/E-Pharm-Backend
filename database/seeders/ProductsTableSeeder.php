<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id'        => 1,
            'product_name'       =>'abatacept',
            'price'             =>'150'

        ]);
        Product::create([
            'category_id'        => 2,
            'product_name'       =>'Amoxicillin',
            'price'             =>'250'


        ]);
        Product::create([
            'category_id'        => 3,
            'product_name'      =>'Brilinta',
            'price'             =>'200'


        ]);
        Product::create([
            'category_id'        => 4,
            'product_name'        =>'Bunavail',
            'price'             =>'250'


        ]);
        Product::create([
            'category_id'        => 1,
            'product_name'     =>'Buprenorphine',
            'price'             =>'350'


        ]);
        Product::create([
            'category_id'        => 2,
            'product_name'       =>'Clindamycin',
            'price'             =>'200'


        ]);
        Product::create([
            'category_id'        => 4,
            'product_name'       =>'Humira',
            'price'             =>'250'


        ]);
        Product::create([
            'category_id'        => 3,
            'product_name'       =>'Metformin',
            'price'             =>'250'


        ]);
        Product::create([
            'category_id'        => 1,
            'product_name'        =>'Tramadol',
            'price'             =>'100'


        ]);
       
        Product::create([
            'category_id'        => 2,
            'product_name'       =>'Ozempic',
            'price'              =>'650'


        ]);
    }
}
