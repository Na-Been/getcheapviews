<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyNow extends Model
{
    use HasFactory;
    protected $table='buy_nows';
    protected $fillable=[
      'link','current_data','contact_email','product_name'
    ];
}
