<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showList() {
        return view('list');
    }

    public function showRegistForm() {
        return view('regist');
        
    }

    public function showProductInfo() {
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();
        return view('productinfo', ['products' => $products]);
    }

    public function showEditForm() {
        return view('newproduct');
    }
    public function showProductInfo2() {
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();
        return view('productdetail', ['products' => $products]);
    }
    public function showEditForm2() {
        return view('infoediting');
    }


    public function registSubmit(ProductRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト
        return redirect(route('regist'));
    }
}
