<!DOCTYPE html>
@extends('layouts.app')

@section('title', '登録画面')

@section('content')
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規登録画面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        .register-container {
            //background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            //box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-container .register-btn {
            background-color:rgb(236, 133, 14);
            color: white;
        }
        .button-container .back-btn {
            background-color:rgb(1, 204, 255);
            color: white;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>ユーザー新規登録</h2>
    <form action="" method="POST">
        <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワードを入力" required>
        </div>
        <div class="form-group">
        <label for="email">アドレス</label>
        <input type="email" id="email" name="email" placeholder="メールアドレスを入力" required>
        </div>
        <div class="button-container">
            <button type="submit" class="register-btn">新規登録</button>
            <button type="button" class="back-btn" onclick="window.history.back();">戻る</button>
        </div>
    </form>
</div>
 @csrf
</body>
</html>
@endsection