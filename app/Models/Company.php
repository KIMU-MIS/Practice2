<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // これを追加
    protected $fillable = [
        'company_name',
    ];
    
    public function products()
{
    return $this->hasMany(Product::class, 'company_id', 'id');
}

}
