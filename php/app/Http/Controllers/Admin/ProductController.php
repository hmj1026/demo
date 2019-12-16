<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Presenters\Product\{ CategoryPresenter, SubCategoryPresenter };
use App\Presenters\StatusPresenter;

class ProductController extends Controller
{
    private $categoryPresenter;
    private $subCategoryPresenter;
    private $statusPresenter;

    public function __construct(
        CategoryPresenter $categoryPresenter,
        SubCategoryPresenter $subCategoryPresenter,
        StatusPresenter $statusPresenter)
    {
        $this->categoryPresenter = $categoryPresenter;
        $this->subCategoryPresenter = $subCategoryPresenter;
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $admin = auth()->guard('admin')->user();
        $data = Product::where('id', $product->id)->with(['details' => function($query) {
            return $query->where('type', 'intro')->active();
        }])->first();

        $isEditadle = $admin->can('update', $data);
        $options = ['content_header' => '產品概要', 'can_edit' => $isEditadle];
        
        return view('admin.product.detail', compact('data', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {   
        $params = $request->only(['name', 'desc', 'price_com', 'price_web', 'comment', 'status']);
        $detail = $request->get('detail');

        DB::beginTransaction();

        try {
            Product::where('id', $product->id)->update($params);
            ProductDetail::where('id', $detail['id'])->update(['content' => $detail['content']]);

            DB::commit();
            return back()->with(['message' => '更新成功', 'class' => 'success']);
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
        
        return back()->with(['message' => '更新失敗', 'class' => 'danger']);
    }

    public function getProductsData(Request $request)
    {
        $products = Product::all();

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                return '<a href="'.route('admin.product.detail', $product->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('desc', function($product) {
                $descOri = !empty($product->desc) ? $product->desc : '';
                $descCut = strlen($product->desc) > 20 ? mb_substr($product->desc, 0, 8, 'utf-8').'....<i class="icon-info-sign"></i>' : $product->desc;

                return '<div data-toggle="tooltip" data-placement="top" title="'.$descOri.'">'.$descCut.'</div>';
            })
            ->editColumn('category_id', function($product) {
                return $this->categoryPresenter->getCategory($product, 'title');
            })
            ->editColumn('sub_category_id', function($product) {
                $subCategory = $this->subCategoryPresenter->getSubCategory($product, 'title');

                return trans('product/sub_category.'.$subCategory);
            })
            ->editColumn('status', function($product) {
                $status = $this->statusPresenter->getStatus($product, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function($product) {
                $time = Carbon::now();

                if ($product->created_at instanceof Carbon) {
                    $time =  $product->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['action', 'status' ,'desc'])
            ->make(true);
    }
}
