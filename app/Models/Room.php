<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('players')
            ->withTimestamps();
    }
}
