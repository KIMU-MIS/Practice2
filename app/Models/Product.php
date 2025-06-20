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

public static function searchProducts(array $filters, $sort = 'products.id', $direction = 'asc')
{ 
  
    // 検索条件に基づいて商品を取得
    $query = self::with('company');

// キーワード検索（商品名、コメントなど）
    if (!empty($filters['keyword'])) {
     $query->where(function ($q) use ($filters) {
        $keyword = $filters['keyword'];

        // 数字（整数）だけなら price や stock 、品名を完全一致で探す
        if (ctype_digit($keyword)) {
            $q->orWhere('price', '=', $keyword)
              ->orWhere('stock', '=', $keyword);
            }
         // 商品名・コメントは部分一致
        $q->orWhere('product_name', 'like', '%' . $keyword . '%')
          ->orWhere('comment', 'like', '%' . $keyword . '%');
    });
}
// 会社IDでの絞り込み
    if (!empty($filters['company_id'])) {
        $query->where('products.company_id', $filters['company_id']);
    }
// 価格・在庫の範囲指定
 // 価格の最小・最大値
    if (!empty($filters['price_min'])) {
    $query->where('products.price', '>=', $filters['price_min']);
    }
    if (!empty($filters['price_max'])) {
    $query->where('products.price', '<=', $filters['price_max']);
    }
 // 在庫の最小・最大値
    if (!empty($filters['stock_min'])) {
    $query->where('products.stock', '>=', $filters['stock_min']);
    }
    if (!empty($filters['stock_max'])) {
    $query->where('products.stock', '<=', $filters['stock_max']);
    }
// ソート処理
$sortable = [
    'id' => 'products.id',
    'price' => 'products.price',
    'stock' => 'products.stock',
];

// $sort が無効なら id にフォールバック
$sort = $filters['sort'] ?? 'id';
$direction = $filters['direction'] ?? 'asc';
$sortColumn = $sortable[$sort] ?? 'products.id';

// ソート実行
$query->orderBy($sortColumn, $direction);
 
  return $query->get();;
    
}
}
