<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['product_name', 'price', 'stock','category'];
    protected $primaryKey = 'product_id';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class); // สินค้าหนึ่งชิ้น อาจถูกสั่งซื้อลงในหลายออเดอร์
    }
}
