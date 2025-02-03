<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['customer_id', 'order_at' , 'status'];
    protected $primaryKey = 'order_id';

    public function customer()
    {
        return $this->belongsTo(Customer::class); // คำสั่งซื้อแต่ละรายการเป็นของลูกค้าคนเดียว
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class); // คำสั่งซื้อหนึ่งรายการมีสินค้าหลายชิ้น
    }
}
