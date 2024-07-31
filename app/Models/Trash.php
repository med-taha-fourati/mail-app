<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;

    public function user_id() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'from',
        'to',
        'subject',
        'content'
    ];
}
