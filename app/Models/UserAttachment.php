<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'file'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
