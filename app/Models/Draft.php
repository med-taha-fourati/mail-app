<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    public function user_id() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'to',
        'from',
        'subject',
        'content'
    ];
}
