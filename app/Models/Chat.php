<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id', 'consultant_id', 'status'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function consultant()
{
    return $this->belongsTo(User::class, 'consultant_id');
}


    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
