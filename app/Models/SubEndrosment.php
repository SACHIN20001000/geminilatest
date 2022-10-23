<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEndrosment extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['message','image','endrosment_id','created_by','created_to'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
 
}
