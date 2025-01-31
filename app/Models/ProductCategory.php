<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['category_name', 'description'];

    public function products()
    {
        
        return $this->hasMany(ProductList::class); // ประเภทสินค้าหนึ่งประเภท มีสินค้าหลายรายการ
    }
}
