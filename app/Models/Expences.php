<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expences extends Model
{
    use HasFactory;
    protected $fillable = ['rent','user_id','electricity','water_bill','tea','stationery','salery','internet','repair','commision'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
