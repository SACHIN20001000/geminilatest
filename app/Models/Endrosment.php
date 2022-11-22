<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endrosment extends Model
{
    use HasFactory;
    protected $fillable = ['new_message','previous_message','image','lead_id','parent','created_by','created_to','type'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function subEndrosment()
    {
        return $this->hasMany(SubEndrosment::class, 'endrosment_id','id');
    }
}
