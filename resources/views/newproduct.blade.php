
@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('content')



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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


    <div class="form-container">
        <h2>商品新規登録画面</h2>
        <form action="{{ route('button') }}" method="post" enctype="multipart/form-data">
        @csrf  
        
        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                 @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif

            <div>
                <label for="product_name">商品名<span class="required">*</span></label>
                <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
                @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
            </div>

            <div>
            <label for="company_name">メーカー名<span class="required">*</span></label>
              <select id="company_id" name="company_id" required>
                 <option value="">-- メーカーを選択 --</option>
                   @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                     {{ $company->company_name }}
                 </option>
                  @endforeach
                </select>
                   @if ($errors->has('company_id'))
                   <p>{{ $errors->first('company_id') }}</p>
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
                <label for="img_path">商品画像</label>
                <input type="file" id="img_path" name="img_path" >
                @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
            </div>

            <div>
                <button type="submit" >新規登録</button>
                
                <button type="button" class="back-btn" onclick="history.back()">戻る</button>
                
            </div>
        </form>
    </div>


@endsection