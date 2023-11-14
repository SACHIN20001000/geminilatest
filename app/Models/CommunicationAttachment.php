<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['communication_id','file_name','file_path'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function communication()
    {
        return $this->belongsTo(Communication::class, 'communication_id');
    }
}
