<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        'product_name' => 'required|max:255',
        'company_id'   => 'required|exists:companies,id',
        'price'        => 'required|numeric',
        'stock'        => 'required|integer',
        'comment'      => 'nullable|string|max:10000',
        'img_path'     => 'nullable|image|max:2048',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 422)
        );
    }

    public function attributes()
   {
    return [
        'product_name' => '商品名',
        'company_name' => 'メーカー名',
        'price' => '価格',
        'stock' => '在庫数',
        'comment' => 'コメント',
       
    ];
 }

public function messages() {
    return [
        'product_name.required' => ':attributeは必須項目です。',
        'product_name.max' => ':attributeは:max字以内で入力してください。',
        'company_name.required' => ':attributeは必須項目です。',
        'company_name.max' => ':attributeは:max字以内で入力してください。',
        'price.required' => ':attributeは必須項目です。',
        'price.max' => ':attributeは:max字以内で入力してください。',
        'stock.required' => ':attributeは必須項目です。',
        'stock.max' => ':attributeは:max字以内で入力してください。',
        'comment.max' => ':attributeは:max字以内で入力してください。',
    ];
}
}
