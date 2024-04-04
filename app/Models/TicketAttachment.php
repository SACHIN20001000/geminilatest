<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;


    protected $fillable = ['ticket_id', 'user_id', 'file'];

    public function ticket()
    {
        return $this->belongsTo(TicketSystem::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttachmentPathAttribute()
    {
        return asset('attachments/' . $this->file);
    }

    


}
