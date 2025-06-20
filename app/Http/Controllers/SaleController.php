<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
   public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $product = Product::find($request->product_id);

            // 在庫不足ならエラー
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => '在庫が不足しています'
                ], 400);
            }

            // salesに購入記録
            Sale::create([
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);

            // productsの在庫を減らす
            $product->stock -= $request->quantity;
            $product->save();

            return response()->json([
                'success' => true,
                'message' => '購入が完了しました'
            ]);
        });
    }
}
