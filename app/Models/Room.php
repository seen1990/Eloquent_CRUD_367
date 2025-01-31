<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['room_number', 'status', 'type_id'];
    protected $primaryKey = 'room_id';

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'type_id');//1 ห้องต่อ 1 ประเภทห้อง
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id');//1 ห้องมีหลายการจอง
    }
}
