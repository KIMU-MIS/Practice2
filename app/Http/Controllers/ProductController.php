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
    //public function showList() {
        //return view('list');
    //}

    //public function showRegistForm() {
        //return view('regist');
        
    //}
  //public function showProductListDetail() {
        // 商品情報詳細画面
       //$model = new Product();
       //$products = $model->getList();
       //return view('productdetail', ['products' => $products]);
   // }➔下記public function showDetail($id)記載


    public function showProductInfo() {
        //商品一覧画面
        $model = new Product();
        $products = $model->getList();
        return view('productinfo', ['products' => $products]);
    }
  
// 商品新規登録画面と商品情報編集画面の表示   
    public function showForm($id = null)
{
    $companies = Company::all();

    if ($id) {
        // 商品情報編集画面
        $product = Product::findOrFail($id);
        return view('infoediting', [
            'product' => $product,
            'companies' => $companies
        ]);
    } else {
        // 商品新規登録画面
        return view('newproduct', [
            'companies' => $companies
        ]);
    }
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

public function update(Request $request, $id)
{
    // バリデーション
    $request->validate([
        'product_name' => 'required|string|max:255',
        'company_id'   => 'required|exists:companies,id',
        'price'        => 'required|numeric',
        'stock'        => 'required|integer',
        'comment'      => 'nullable|string',
        'img_path'     => 'nullable|image|max:2048', 
    ]);

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

    // 更新後に詳細ページにリダイレクト
    return redirect()->route('product.show', $product->id)
                     ->with('success', '商品情報を更新しました');
}

public function index(Request $request)
{
    $products = Product::searchProducts($request->all());
    $companies = Company::all();

    return view('productinfo', compact('products', 'companies'));
}


public function edit($id)//（商品編集画面の表示用）
{
   // joinして、products と companies を結合して取得
    $product = Product::withCompanyById($id);
    $companies = Company::all();

    return view('edit', compact('product', 'companies'));
}

public function showDetail($id)//（商品詳細画面の表示）
{
     $product = Product::withCompanyById($id);
    return view('productdetail', compact('product'));
}

}