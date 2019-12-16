<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function index($id)
    {
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
                        'attach_flag' => '',
                        'attach_src' => 'https://www.youtube.com/embed/oIxm0OTdfc8?rel=0',
                        'attach_name' => '',
                        'is_cover' => 0,
                    ],
                    [
                        'id' => 6,
                        'product_id' => 1,
                        'attach_type' => 'video',
                        'attach_kind' => 'link',
                        'attach_flag' => '',
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
                        'attach_flag' => '',
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

        $filtered = collect($datas)->filter(function($product) use ($id) {
            return $product['id'] == $id; 
        });

        $data = Arr::first($filtered) ?: [];

        return view('product.index', compact('data'));
    }
}
