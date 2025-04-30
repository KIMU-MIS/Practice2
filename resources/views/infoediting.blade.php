<!DOCTYPE html>
@extends('layouts.app')

@section('title', '商品情報編集画面')

@section('content')

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報編集画面</title>
    <style>
        /* 赤色の*マーク */
        .required {
            color: red;
        }
        /* フォームのスタイル */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
        }
        .form-container input,
        .form-container textarea {
            width: 95%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            background-color:rgb(255, 155, 4);
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color:rgb(255, 155, 4);
        }
        .form-container .back-btn {
            background-color:rgb(35, 211, 255);
        }
        .form-container .back-btn:hover {
            background-color:rgb(35, 211, 255);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>商品情報編集画面</h2>
        <form action="register_complete.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="12345" disabled>
            </div>
            <div>
                <label for="product-name">商品名<span class="required">*</span></label>
                <input type="text" id="product-name" name="product_name" required>
            </div>

            <div>
                <label for="manufacturer-name">メーカー名<span class="required">*</span></label>
                <input type="text" id="manufacturer-name" name="manufacturer_name" required>
            </div>

            <div>
                <label for="price">価格<span class="required">*</span></label>
                <input type="number" id="price" name="price" required>
            </div>
            <div>
                <label for="stock">在庫数<span class="required">*</span></label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div>
                <label for="comment">コメント</label>
                <textarea id="comment" name="comment" rows="4"></textarea>
            </div>
            <div>
                <label for="product-image">商品画像</label>
                <input type="file" id="product-image" name="product_image">
            </div>

            <div>
                <button type="submit" onclick="location.href='http://localhost:80/practice2/public/productdetail'">更新</button>
                <a href="javascript:history.back();">
                    <button type="button" class="back-btn">戻る</button>
                </a>
            </div>
        </form>
    </div>

@csrf
</body>
</html>
@endsection