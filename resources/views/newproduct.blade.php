<!DOCTYPE html>
@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品新規登録画面</title>
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
        <h2>商品新規登録画面</h2>
        <form action="{{ route('button') }}" method="post" enctype="multipart/form-data">
        @csrf   
            <div>
                <label for="product-name">商品名<span class="required">*</span></label>
                <input type="text" id="product-name" name="product_name" value="{{ old('product-name') }}" required>
                @if($errors->has('product-name'))
                        <p>{{ $errors->first('product-name') }}</p>
                    @endif
            </div>

            <div>
                <label for="manufacturer-name">メーカー名<span class="required">*</span></label>
                <input type="text" id="manufacturer-name" name="manufacturer_name" value="{{ old('manufacturer-name') }}" required>
                @if($errors->has('manufacturer-name'))
                        <p>{{ $errors->first('manufacturer-name') }}</p>
                    @endif
            </div>

            <div>
                <label for="price">価格<span class="required">*</span></label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required>
                @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif       
            </div>
            <div>
                <label for="stock">在庫数<span class="required">*</span></label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
                @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
            </div>
            <div>
                <label for="comment">コメント</label>
                <textarea id="comment" name="comment" rows="4">{{ old('comment') }}</textarea>
                @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
            </div>
            <div>
                <label for="product-image">商品画像</label>
                <input type="file" id="product-image" name="product_image" value="{{ old('product-image') }}">
                @if($errors->has('product-image'))
                        <p>{{ $errors->first('product-image') }}</p>
                    @endif
            </div>

            <div>
                <button type="button" onclick="location.href='http://localhost:80/practice2/public/productinfo'">新規登録</button>
                <a href="javascript:history.back();">
                    <button type="button" class="back-btn">戻る</button>
                </a>
            </div>
        </form>
    </div>

</body>
</html>
@endsection