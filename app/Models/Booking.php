<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{   
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['booked_at','check_in', 'check_out', 'room_id', 'customer_id','status'];
    protected $primaryKey = 'booking_id';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');//1 การจองต่อ 1 ลูกค้า
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');//1 การจองต่อ 1 ห้อง
    }
}
