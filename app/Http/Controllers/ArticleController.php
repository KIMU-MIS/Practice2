<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function showList() {
        return view('list');
    }

    public function showRegistForm() {
        return view('regist');
        
    }

    public function showProductInfo() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('productinfo', ['articles' => $articles]);
    }

    public function showEditForm() {
        return view('newproduct');
    }
    public function showProductInfo2() {
        // インスタンス生成
        $model = new Article();
        $articles = $model->getList();
        return view('productdetail', ['articles' => $articles]);
    }
    public function showEditForm2() {
        return view('infoediting');
    }


    public function registSubmit(ArticleRequest $request) {

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Article();
            $model->registArticle($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト
        return redirect(route('regist'));
    }
    
}





