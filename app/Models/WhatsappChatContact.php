<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappChatContact extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'contact_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'contact_id');
    }
}
