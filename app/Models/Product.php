<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select(
            'products.id AS ID',
            'products.product_name AS 商品名',
            'products.price AS 価格',
            'products.stock AS 在庫数',
            'companies.company_name AS メーカー名'
        )
        ->get();
        return $products;
            
    }

   

    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'id' => $data->id,
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
        ]);
    }
}
