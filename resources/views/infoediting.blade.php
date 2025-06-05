
@extends('layouts.app')

@section('title', '商品情報編集画面')

@section('content')
       
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
          .error {
        color: red;
        font-size: 0.9em;
        margin-top: 4px;
    }
    </style>


    <div class="form-container">
        <h2>商品情報編集画面</h2>
        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
           <div>
                <label for="id">ID:</label>
                <input type="hidden" name="id" value="{{ $product->id }}">
                @if($errors->has('id'))
                        <p>{{ $errors->first('id') }}</p>
                    @endif
            </div>
            <div>
                <label for="product-name">商品名<span class="required">*</span></label>
                <input type="text" id="product-name" name="product_name" value="{{ old('product_name', $product->product_name) }}" >
                 @error('product_name')
                   <p class="error">{{ $message }}</p>
                 @enderror
            </div>

            <div>
               <label for="company_id">メーカー名<span class="required">*</span></label>
               <select id="company_id" name="company_id" >
                @foreach ($companies as $company)
               <option value="{{ $company->id }}"
                 {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                   {{ $company->company_name }}
                </option>
                @endforeach
               </select>
               @error('company_id') 
                <p class="error">{{ $message }}</p> 
               @enderror
                </div>

            <div>
                <label for="price">価格<span class="required">*</span></label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" >
                @error('price') 
                  <p class="error">{{ $message }}</p> 
                @enderror
            </div>
            <div>
                <label for="stock">在庫数<span class="required">*</span></label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" >
                @error('stock') 
                 <p class="error">{{ $message }}</p> 
                @enderror
            </div>
            <div>
                <label for="comment">コメント</label>
                <textarea id="comment" name="comment" rows="4">{{ old('comment', $product->comment) }}</textarea>
                @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
            </div>
            <div>
                <label for="img_path">商品画像</label>
                <input type="file" id="img_path" name="img_path">
                @if($errors->has('img_path'))
                        <p>{{ $errors->first('img_path') }}</p>
                    @endif
            </div>

            <div>
                <button type="submit">更新</button>
                <a href="javascript:history.back();">
                    <button type="button" class="back-btn">戻る</button>
                </a>
            </div>
        </form>
    </div>

@endsection