<?php

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\ProductDetail;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        // DB::table('products_attachs')->truncate();

        $datas = [
            [
                'id' => 1,
                'category_id' => 1,
                'sub_category_id' => 1,
                'name' => 'H917 鑄鋁磁控飛輪車',
                'desc' => '自然帶動慣性 靜音磁控阻力 雙重需求一機俱備',
                'price_com' => 44000,
                'price_web' => 36000,
                'attachs' => [
                    [
                        'id' => 1,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 1,
                    ],
                    [
                        'id' => 2,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 3,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 4,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 5,
                        'product_id' => 1,
                        'attach_type' => 'video',
                        'attach_kind' => 'link',
                        'attach_flag' => 'youtube',
                        'attach_src' => 'https://www.youtube.com/embed/oIxm0OTdfc8?rel=0',
                        'attach_name' => '',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 6,
                        'product_id' => 1,
                        'attach_type' => 'video',
                        'attach_kind' => 'link',
                        'attach_flag' => 'youtube',
                        'attach_src' => 'https://www.youtube.com/embed/oIxm0OTdfc8?rel=0',
                        'attach_name' => '',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 7,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507001.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 8,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507002.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 9,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507003.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 10,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => '1811231628502.jpg',
                        'is_cover' => 0,
                    ],
                ]
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'sub_category_id' => 1,
                'name' => 'BT6385C 電動跑步機',
                'desc' => '自然帶動慣性 靜音磁控阻力 雙重需求一機俱備',
                'price_com' => 44000,
                'price_web' => 36000,
                'attachs' => [
                    [
                        'id' => 1,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 1,
                    ],
                    [
                        'id' => 2,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 3,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 4,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'carousel',
                        'attach_src' => 'images/',
                        'attach_name' => 'H915A-600x480.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 5,
                        'product_id' => 1,
                        'attach_type' => 'video',
                        'attach_kind' => 'link',
                        'attach_flag' => 'youtube',
                        'attach_src' => 'https://www.youtube.com/embed/oIxm0OTdfc8?rel=0',
                        'attach_name' => '',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 6,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507001.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 7,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507002.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 8,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507003.jpg',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 9,
                        'product_id' => 1,
                        'attach_type' => 'image',
                        'attach_kind' => 'file',
                        'attach_flag' => 'desc',
                        'attach_src' => 'images/',
                        'attach_name' => 'BH-H917-IndoorBike-180507003.jpg',
                        'is_cover' => 0,
                    ],
                ]
            ],
        ];

        collect($datas)->each(function($data) {
            $insertProduct = collect($data)->except(['id', 'attachs'])->all() ?: [];
            
            if ($insertProduct) {
                $productId = Product::insertGetId($insertProduct);
            }

            if ($productId) {
                ProductDetail::insert([
                    'product_id' => $productId,
                    'type' => 'intro'
                ]);
            }

            // if ($productId) {
            //     $insertAttachs = collect($data)->only('attachs')->get('attachs');
                
            //     collect($insertAttachs)->each(function($attach) use($productId) {
            //         $insertAttach = collect($attach)->except('id');
                    
            //         $insertAttach = $insertAttach->put('product_id', $productId)->all() ?: [];
                    
            //         ProductAttach::insert($insertAttach);
            //     });
            // }
        });
    }
}
