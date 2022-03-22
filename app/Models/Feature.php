<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'features';
    protected $fillable = [
      'feature_title','product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
