<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['type_name', 'description', 'price_per_night'];
    protected $primaryKey = 'type_id';

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type_id'); //ห้อง 1 ประเภทห้องมีหลายห้อง
    }
}
