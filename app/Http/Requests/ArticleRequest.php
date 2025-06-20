<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required | max:255',
            'mail' => 'required | max:255 | mail',
            'product-name' => 'required | max:255',
            'manufacturer-name' => 'required | max:255',
            'price' => 'required | max:255',
            'stock' => 'required | max:255',
            'comment' => 'max:10000',
            //
        ];
    }

/**
 * 項目名
 *
 * @return array
 */
public function attributes()
{
    return [
        'password' => 'パスワード',
        'mail' => 'メールアドレス',
        'product-name' => '商品名',
        'manufacturer-name' => 'メーカー名',
        'price' => '価格',
        'stock' => '在庫数',
        'comment' => 'コメント',
       
    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'password.required' => ':attributeは必須項目です。',
        'password.max' => ':attributeは:max字以内で入力してください。',
        'mail.required' => ':attributeは必須項目です。',
        'mail.max' => ':attributeは:max字以内で入力してください。',
        'mail.mail' => ':attributeはURL形式で入力してください。',
        'product-name.required' => ':attributeは必須項目です。',
        'product-name.max' => ':attributeは:max字以内で入力してください。',
        'manufacturer-name.required' => ':attributeは必須項目です。',
        'manufacturer-name.max' => ':attributeは:max字以内で入力してください。',
        'price.required' => ':attributeは必須項目です。',
        'price.max' => ':attributeは:max字以内で入力してください。',
        'stock.required' => ':attributeは必須項目です。',
        'stock.max' => ':attributeは:max字以内で入力してください。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
    ];
}

}
