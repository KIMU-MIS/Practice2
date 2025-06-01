<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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

 public static function withCompanyById($id)
{
    return self::join('companies', 'products.company_id', '=', 'companies.id')
        ->select(
            'products.id',
            'products.product_name',
            'products.price',
            'products.stock',
            'products.comment',
            'products.img_path',
            'products.company_id',
            'companies.company_name'
        )
        ->where('products.id', $id)
        ->first();
}  

public static function searchProducts($params)
{ // 検索条件に基づいて商品を取得
    $query = self::join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name');
    // キーワード検索（商品名、コメントなど）
    if (!empty($params['keyword'])) {
        $keyword = $params['keyword'];
        $query->where(function ($q) use ($keyword) {
            $q->where('products.product_name', 'like', "%{$keyword}%")
              ->orWhere('products.comment', 'like', "%{$keyword}%");
            // キーワードが数字の場合、価格・在庫にもマッチ
            if (is_numeric($keyword)) {
                $q->orWhere('products.price', '=', $keyword)
                  ->orWhere('products.stock', '=', $keyword);
            }
        });
    }

    if (!empty($params['company_id'])) {
        $query->where('products.company_id', $params['company_id']);
    }

    return $query->get();
}
}
