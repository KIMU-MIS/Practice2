<!DOCTYPE html>
@extends('layouts.app')

@section('title', '商品情報一覧画面')

@section('content')
<<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-container input,
        .search-container select,
        .search-container button {
            padding: 10px;
            font-size: 16px;
            margin: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        .button-container button {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .new-btn {
            background-color:rgb(255, 155, 4);
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-container .detail-btn {
            background-color:rgb(35, 211, 255);
            color: white;
        }
        .button-container .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        .button-container .register-btn {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- 検索フォーム -->
    <h2>商品一覧画面</h2> 
    <div class="search-container">
    
        <div>
            <input type="text" id="searchKeyword" name="keyword" placeholder="検索キーワード" />
        </div>
        <div>
            <select name="company">
                <option value="">メーカー名を選択</option>
                <option value="メーカー1">メーカー1</option>
                <option value="メーカー2">メーカー2</option>
                <option value="メーカー3">メーカー3</option>
                <!-- 他のメーカーを追加 -->
            </select>
        </div>
        <div>
            <button type="submit" id="searchBtn">検索</button>
        </div>
    
    </div>

    <!-- 商品一覧表 -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                    <th><button class="new-btn" onclick="location.href='http://localhost:80/practice2/public/newproduct'">新規登録</button></th>
                </tr>
            </thead>
            <tbody>
                <!-- 商品一覧を動的に表示 -->
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" /></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>
                        <div class="button-container">
                            <button class="detail-btn" onclick="location.href='http://localhost:80/practice2/public/productdetail'">詳細</button>
                            <button class="delete-btn">削除</button>
                        </div>
                    </td>
                </tr>
                @endforeach
               
                <!-- 他の商品行を追加 -->
            </tbody>
        </table>
    </div>

</div>

<script>
    // 検索ボタンの処理
    document.getElementById('searchBtn').addEventListener('click', function() {
        const keyword = document.getElementById('searchKeyword').value;
        const manufacturer = document.getElementById('manufacturerSelect').value;

        // 実際の検索処理をここに実装する（例：API呼び出し、テーブルのフィルタリングなど）
        console.log('検索キーワード:', keyword);
        console.log('メーカー名:', manufacturer);
        // 例：商品をフィルタリングして表示
    });

    // 削除ボタンの処理
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm('本当に削除してもよろしいですか？')) {
                // 実際の削除処理をここに実装する
                alert('商品が削除されました');
            }
        });
    });
</script>
@csrf
</body>
</html>
@endsection