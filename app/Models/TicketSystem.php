<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSystem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'policy_id', 'type', 'document', 'current_value', 'new_value', 'status'];

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id' , 'id');
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id')->orderBy('created_at', 'desc');
    }

    public function remarkDetails()
    {
        return $this->hasMany(TicketRemark::class, 'ticket_id')->orderBy('created_at', 'desc');
    }
}
