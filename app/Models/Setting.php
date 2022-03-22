<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $fillable=[
        'title', 'logo', 'short_name', 'contact', 'address', 'email','description',
        'facebook_link','instagram_link','twitter_link','skype_link','mode_status'
    ];
}


