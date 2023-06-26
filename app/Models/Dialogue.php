<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dialogue extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function messages()
    {
        return $this->hasMany(Message::class, 'dialogue_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_dialogues', 'dialogue_id', 'user_id');
    }
}
