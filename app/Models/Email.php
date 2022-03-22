<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';
    protected $fillable = [
        'to', 'subject', 'message', 'user_id','template_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
