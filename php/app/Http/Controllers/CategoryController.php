<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category = null)
    {
        $datas = [
            'machines' => [
                'title' => '健身器材',
                'products' => [
                    [
                        'id' => 1,
                        'name' => '鑄鋁磁控飛輪車',
                        'desc' => '自然帶動慣性  靜音磁控阻力 雙重需求一機俱全',
                        'price_com' => '44000',
                        'price_web' => '36000',
                        'link' => '',
                        'attachs' => 'images/indBestPro-bike-H917.png'
                    ],
                    [
                        'id' => 2,
                        'name' => '電動跑步機',
                        'desc' => '可變動的旋轉避震 自由調整多種跑感模擬更多元的地面感受',
                        'price_com' => '44000',
                        'price_web' => '36000',
                        'link' => '',
                        'attachs' => 'images/indBestPro-trea-BT6385C.png'
                    ]
                ]
            ],
            'gadgets' => [
                'title' => '健身小物',
                'products' => []
            ],
            'accessories' => [
                'title' => '器材配件',
                'products' => []
            ]
        ];

        $data = $datas[$category] ?? ['title' => 'list all'];

        return view('category.index', compact('data'));
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
