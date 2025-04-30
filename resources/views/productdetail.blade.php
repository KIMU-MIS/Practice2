<!DOCTYPE html>
@extends('layouts.app')

@section('title', '商品情報一覧画面')

@section('content')

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報詳細画面</title>
    <style>
        /* フォームのスタイル */
        .detail-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .detail-container h2 {
            //text-align: center;
        }
        .detail-container dl {
            margin-bottom: 20px;
        }
        .detail-container dt {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .detail-container dd {
            margin-left: 20px;
            margin-bottom: 10px;
        }
        .detail-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .detail-container button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            background-color:rgb(255, 155, 4);
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .detail-container button:hover {
            background-color:rgb(255, 155, 4);
        }
        .detail-container .back-btn {
            background-color:rgb(35, 211, 255);
        }
        .detail-container .back-btn:hover {
            background-color:rgb(35, 211, 255);
        }
    </style>
</head>
<body>
    <div class="detail-container">
        <h2>商品情報詳細画面</h2>
        
        <dl>
            <dt>ID:</dt>
            <dd>12345</dd> <!-- 商品IDをここに表示 -->

            <dt>商品画像:</dt>
            <dd><img src="product-image.jpg" alt="商品画像"></dd> <!-- 商品画像のリンクをここに指定 -->

            <dt>商品名:</dt>
            <dd>商品名例</dd> <!-- 商品名をここに表示 -->

            <dt>メーカー:</dt>
            <dd>メーカー名例</dd> <!-- メーカー名をここに表示 -->

            <dt>価格:</dt>
            <dd>¥1000</dd> <!-- 価格をここに表示 -->

            <dt>在庫数:</dt>
            <dd>50</dd> <!-- 在庫数をここに表示 -->

            <dt>コメント:</dt>
            <dd>商品の詳細コメントがここに表示されます。</dd> <!-- コメントをここに表示 -->
        </dl>

        <div class="button-container">
    
                <button type="button" onclick="location.href='http://localhost:80/practice2/public/infoediting'">編集</button> <!-- 編集ページへのリンク -->
           
            
            <a href="javascript:history.back();">
                <button type="button" class="back-btn">戻る</button> <!-- 戻るボタン -->
            </a>
        </div>
    </div>

@csrf
</body>
</html>
@endsection