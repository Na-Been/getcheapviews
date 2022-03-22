<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $table = 'funds';
    protected $fillable = [
        'method', 'amount', 'user_id','token_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
