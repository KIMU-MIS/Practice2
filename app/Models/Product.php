<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }
    

    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            //'password' => $data->password,
            //'mail' => $data->mail,
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->img_path,
        ]);
    }
}
