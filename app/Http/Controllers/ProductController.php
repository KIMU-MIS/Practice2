<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
// 商品一覧画面の表示
    public function showProductInfo() {
        //商品一覧画面
        $model = new Product();
        $products = $model->getList();
        return view('productinfo', ['products' => $products]);
    }
  

    public function registSubmit(ProductRequest $request) {
      
        // トランザクション開始
        DB::beginTransaction();
    
        try {
            
           // 画像の保存処理
             $path = null;
             if ($request->hasFile('img_path')) {
              $path = $request->file('img_path')->store('images', 'public');
          }
            // 登録処理呼び出し
            $model = new Product();
            $data = $request;
            $model->registProduct([
                'product_name' => $request->product_name,
                'company_id' => $request->company_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' => $path, // アップロード済み画像のパスを渡す
            ]);
           
            DB::commit(); 
    
        // 処理が完了したらregistにリダイレクト
         return redirect()->route('product.index')->with('success', '商品を登録しました。');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', '登録に失敗しました: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        Product::findOrFail($id)->delete();
        return redirect()->route('productinfo')->with('success', '商品を削除しました。');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => '削除に失敗しました: ' . $e->getMessage()]);
    }
}

public function update(ProductRequest $request, $id)
{

    DB::beginTransaction();

    try {
        // 該当商品取得
        $product = Product::findOrFail($id);

        // データ更新
        $product->product_name = $request->input('product_name');
        $product->company_id   = $request->input('company_id');
        $product->price        = $request->input('price');
        $product->stock        = $request->input('stock');
        $product->comment      = $request->input('comment');

        // 画像アップロードがある場合
        if ($request->hasFile('img_path')) {
            // 古い画像があるなら削除
            if ($product->img_path && Storage::exists('public/' . $product->img_path)) {
                Storage::delete('public/' . $product->img_path);
            }

            // 新しい画像を保存
            $path = $request->file('img_path')->store('images', 'public');
            $product->img_path = $path;
        }

        $product->save();

        DB::commit();

        return redirect()->route('product.show', $product->id)
                         ->with('success', '商品情報を更新しました');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()
                         ->withInput()
                         ->with('error', '商品情報の更新に失敗しました: ' . $e->getMessage());
    }
}

public function index(Request $request)//（商品一覧画面の初期表示・通常の画面表示）view('productinfo') を返す
{
    
     // まず先に sort, direction を定義
    $sort = $request->input('sort', 'id');
    $direction = $request->input('direction', 'desc');

    // その後に検索処理に渡す
    $products = Product::searchProducts($request->all(), $sort, $direction);
    $companies = Company::all();

  if ($request->ajax()) {
        return view('partials.product_list', compact('products'));
    }

    return view('productinfo', compact('products', 'companies', 'sort', 'direction'));
}

public function search(Request $request)//（商品一覧画面の検索ボタンを押した時）view('partials.product_list') を返して render() でHTML化して返す
{
    $products = Product::searchProducts($request->all());

    return view('partials.product_list', compact('products'))->render();
}

public function create()//（商品新規登録画面の表示用）
{
    $companies = Company::all();
    return view('newproduct', compact('companies'));
}

public function edit($id)//（商品編集画面の表示用）
{
   // joinして、products と companies を結合して取得
    $product = Product::withCompanyById($id);
    $companies = Company::all();

    return view('infoediting', compact('product', 'companies'));
}

public function showDetail($id)//（商品詳細画面の表示）
{
     $product = Product::withCompanyById($id);
    return view('productdetail', compact('product'));
}

}