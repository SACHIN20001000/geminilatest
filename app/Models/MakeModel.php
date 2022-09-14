<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeModel extends Model
{
    use HasFactory;
    protected $fillable = ['name','make_id'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function makes()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }
}
