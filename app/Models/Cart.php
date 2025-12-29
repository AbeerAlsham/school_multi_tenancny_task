<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable = [
        'student_id',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // علاقة إلى المستخدم (الطالب)
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
