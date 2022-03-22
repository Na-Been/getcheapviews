<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewOrder extends Model
{
    use HasFactory;

    protected $table = 'new_orders';
    protected $fillable = [
        'category', 'services', 'link', 'quantity', 'charge', 'user_id','status','mark_as_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
