<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class); // รายการนี้อยู่ในคำสั่งซื้อเดียว
    }

    public function product()
    {
        return $this->belongsTo(ProductList::class); // รายการนี้อ้างถึงสินค้าเดียว
    }
}
