<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['message', 'is_attachment'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('/') . '/uploads/' . $this->image : "";
    }

    public static function getLastMessege($user_id, $contact_id)
    {
        $messages =  self::where(function ($query) use ($contact_id) {
            $query->where('from_user', '=', $contact_id)
                ->orWhere('user_id', '=', $contact_id);
        })->where(function ($query) use ($user_id) {
            $query->where('user_id', '=', $user_id)
                ->orWhere('from_user', '=', $user_id);
        });

        return  $messages->orderBy('created_at', 'DESC')->first();
    }
}
