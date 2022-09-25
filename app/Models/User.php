<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name','email','profile','password','birthday','anniversary','account_no','bank_name','account_name','ifsc','upi','photo','pan_card','aadhar_card','gst'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y h:i:s', strtotime($value));
    }
    public function contacts()
    {
        return $this->hasMany(ChatContact::class, 'contact_id','id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'from_user','id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'user_id','id');
    }

    public function messages()
    {
        return $this->messagesSent()->union($this->messagesReceived()->toBase());
    }
}
