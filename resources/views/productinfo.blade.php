
@extends('layouts.app')

@section('title', '商品情報一覧画面')

@section('content')


   
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
         .search-container .input,
        .search-container .select,
        .search-container .button {
        float: left;

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
        .sortable {
            cursor: pointer;
          }
    </style>


<div class="container">
    <!-- 登録可否メッセージ -->
   @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <!-- 検索フォーム -->
    <h2>商品一覧画面</h2> 
    <div class="search-container">
    
    <form id="search-form">
       <div class="input">
        <input type="text" id="keyword" name="keyword" placeholder="検索キーワード">
       </div>

       <div class="select">
          <select name="company_id" id="company_id">
             <option value="">-- メーカー名 --</option>
             @foreach($companies as $company)
                <option value="{{ $company->id }}">
                    {{ $company->company_name }}
                </option>
             @endforeach
           </select>
        </div>
        
        <!-- 価格検索 -->
          <div class="input">
            <label>価格:</label>
            <input type="number" name="price_min" placeholder="下限">
            <input type="number" name="price_max" placeholder="上限">
           </div>

        <!-- 在庫検索 -->
         <div class="input">
            <label>在庫数:</label>
            <input type="number" name="stock_min" placeholder="下限">
            <input type="number" name="stock_max" placeholder="上限">
         </div>

        <!-- 検索ボタン -->
        <div class="button">
          <button type="submit">検索</button>
        </div>
       <input type="hidden" name="sort" id="sort" value="{{ $sort ?? 'id' }}">
       <input type="hidden" name="direction" id="direction" value="{{ $direction ?? 'asc' }}">   
    </form>
    
    </div>

    <!-- 商品一覧表 -->
    <div class="table-container">
       <div id="product-list">
          @include('partials.product_list', ['products' => $products])
       </div>
    </div>

</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@section('scripts') {{-- layouts.app で @yield('scripts') を呼んでおく --}}
<script>
$(document).ready(function () {
     // 検索機能
    $('#search-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('product.index') }}", // Laravelのルート名で指定
            type: 'GET',
            data: $('#search-form').serialize(),
            success: function (data) {
                $('#product-list').html(data);
            },
            error: function () {
                alert('検索に失敗しました');
            }
        });
    });

    // ソート機能
    $(document).on('click', '.sortable', function () {
    const sort = $(this).data('sort');
    const current = $('#direction').val();
    const direction = current === 'asc' ? 'desc' : 'asc';

    
    // hidden input の値を変更
    $('#sort').val(sort);
    $('#direction').val(direction);

    
    // データ属性も更新（UI表示用に使うなら）
    $(this).data('direction', direction);

    // Ajax送信
    $('#search-form').submit();

  }); 

    //削除ボタンの非同期処理
    $(document).on('submit', '.delete-form', function (e) {
    e.preventDefault();

    if (!confirm('本当に削除しますか？')) return;

    const productId = $(this).data('id');
    const token = $('meta[name="csrf-token"]').attr('content'); // CSRFトークン（必要なら）

    $.ajax({
        url: '/product/' + productId,
        type: 'POST',
        data: {
            _method: 'DELETE',
            _token: token
        },
        success: function () {
            // 該当行を削除（エフェクトつけてもOK）
            $('form[data-id="' + productId + '"]').closest('tr').remove();
        },
        error: function () {
            alert('削除に失敗しました');
        }
    });
   });
 
})
</script>
@endsection

