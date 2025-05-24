<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'company_id',  // 注意: company_name ではなく company_id
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
        ->select(
            'products.id AS id',
            'products.product_name AS product_name',
            'products.price AS price',
            'products.stock AS stock',
            'products.img_path AS img_path',
            'products.comment AS comment',
            'companies.company_name AS company_name'
        )
        ->get();
        return $products;
            
    }

   public function company()
{
    return $this->belongsTo(Company::class);
}

    public function registProduct($data) {
        // 登録処理
        DB::table('products')->insert([
            'company_id' => $data['company_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $data['img_path'],// null をそのまま入れる
        ]);
    }
}
