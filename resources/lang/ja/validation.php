<?php

return [
    'required' => ':attribute は必須項目です。',
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'numeric' => ':attribute には数値を入力してください。',
    'integer' => ':attribute には整数を入力してください。',
    'image' => ':attribute には画像ファイルを指定してください。',
    'exists' => '選択された :attribute は正しくありません。',
    
    // カスタム属性名
    'attributes' => [
        'product_name' => '商品名',
        'company_id'   => 'メーカー名',
        'price'        => '価格',
        'stock'        => '在庫数',
        'comment'      => 'コメント',
        'img_path'     => '商品画像',
    ],
];