<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cost_per_hour',
        'cost_per_game',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
