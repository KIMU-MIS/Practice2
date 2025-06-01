
@extends('layouts.app')
@section('title', '商品情報詳細画面')
@section('content')

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
           /* text-align: center; */
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


    <div class="detail-container">
        <h2>商品情報詳細画面</h2>
        
        <table>
          <tr><th>ID:</th>
          <td>{{ $product->id }}</td></tr> <!-- 商品IDをここに表示 -->

          <tr><th>商品画像:</th>
            <td> @if (!empty($product->img_path))
            <img src="{{ asset('storage/' . $product->img_path) }}" width="100"> <!-- 商品画像のリンクをここに指定 -->
             @else
              <span>画像なし</span>
             @endif
            </td></tr>

          <tr><th>商品名:</th>
          <td>{{ $product->product_name }}</td></tr> <!-- 商品名をここに表示 -->

          <tr><th>メーカー:</th>
          <td>{{ $product->company_name }}</td></tr> <!-- メーカー名をここに表示 -->

          <tr><th>価格:</th>
          <td>{{ $product->price }}</td></tr> <!-- 価格をここに表示 -->

          <tr><th>在庫数:</th>
          <td>{{ $product->stock }}</td></tr> <!-- 在庫数をここに表示 -->

          <tr><th>コメント:</th>
          <td>{{ $product->comment }}</td></tr> <!-- コメントをここに表示 -->
            
        </table>

        <div class="button-container">
    
            <a href="{{ route('infoediting', $product->id) }}">
              <button type="button">編集</button> <!-- 編集ページへのリンク -->
            </a>
            
            <a href="{{ route('product.index') }}">
                <button type="button" >戻る</button> <!-- 戻るボタン -->
            </a>
        </div>
    </div>




@endsection