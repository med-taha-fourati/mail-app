<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    public function user_id() {
        return $this->hasMany(User::class);
    }

    public function email() {
        return $this->hasMany(User::class);
    }

    public function trash_id() {
        return $this->hasMany(Trash::class);
    }

    protected $fillable = [
        'user_id',
        'to',
        'from',
        'subject',
        'content',
        'mail_id',
        'trash_id'
    ];
}
