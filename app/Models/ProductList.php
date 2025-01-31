<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['product_name','description', 'stock', 'price', 'category_id'];
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class); // สินค้าแต่ละชิ้นจะอยู่ในประเภทสินค้าเดียว
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class); // สินค้าหนึ่งชิ้น อาจถูกสั่งซื้อลงในหลายออเดอร์
    }
}
