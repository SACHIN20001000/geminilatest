<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remainder extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',
        'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
}
