<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    public function getList() {
        // articlesテーブルからデータを取得
        $articles = DB::table('articles')->get();

        return $articles;
    }


    public function registArticle($data) {
        // 登録処理
        DB::table('articles')->insert([
            //'password' => $data->password,
            //'mail' => $data->mail,
            'product_name' => $data->product_name,
            'manufacturer_name' => $data->manufacturer_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
        ]);
    }
}
