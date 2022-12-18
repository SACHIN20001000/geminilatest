<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;
    protected $fillable = ['name','subproduct_id'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function makeModels()
    {
        return $this->hasOne(MakeModel::class,'make_id','id');
    }
    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'subproduct_id');
    }
}
