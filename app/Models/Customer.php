<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['first_name', 'last_name','gender', 'email', 'phone', 'address'];
    protected $primaryKey = 'customer_id';

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id'); // ลูกค้าหนึ่งคน มีคำสั่งซื้อหลายรายการ
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');//ลูกค้า 1 คน จองได้หลายครั้ง
    }
}
