<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'promo' => [
                [
                    'id' => 1,
                    'class' => 'topImgBanner-1920',
                    'attachs' => 'images/quelea-shop-image.jpg'
                ],
                [
                    'id' => 2,
                    'class' => 'topImgBanner-1024',
                    'attachs' => 'images/quelea-shop-1024-image.jpg'
                ],
            ],
            'banner' => [
                [
                    'id' => 1,
                    'attachs' => 'images/product-banner-1.jpg'
                ],
                [
                    'id' => 2,
                    'attachs' => 'images/product-banner-2.jpg'
                ],
            ],
            'main' => [
                [
                    'id' => 1,
                    'name' => 'H917 鑄鋁磁控飛輪車',
                    'desc' => '自然帶動慣性  靜音磁控阻力 雙重需求一機俱全',
                    'price_com' => '44000',
                    'price_web' => '36000',
                    'link' => '',
                    'attachs' => 'images/indBestPro-bike-H917.png'
                ],
                [
                    'id' => 2,
                    'name' => 'BT6385C 電動跑步機',
                    'desc' => '可變動的旋轉避震 自由調整多種跑感模擬更多元的地面感受',
                    'price_com' => '44000',
                    'price_web' => '36000',
                    'link' => '',
                    'attachs' => 'images/indBestPro-trea-BT6385C.png'
                ]
            ],
            'sub' => [
                [
                    'id' => 1,
                    'type' => 'BH 飛輪車專用',
                    'name' => '新款電子錶手機平板托架組',
                    'price_com' => '4460',
                    'price_web' => '980',
                    'attachs' => 'images/1808101059232.jpg'
                ],
                [
                    'id' => 2,
                    'type' => 'BH 飛輪車專用',
                    'name' => '簡易手機托架組',
                    'price_com' => '4460',
                    'price_web' => '980',
                    'attachs' => 'images/1811231628502.jpg'
                ],
                [
                    'id' => 3,
                    'type' => '',
                    'name' => 'BH專屬運動水壺',
                    'price_com' => '4460',
                    'price_web' => '980',
                    'attachs' => 'images/1606271721182.jpg'
                ]
            ],
        ];
        
        return view('home.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
