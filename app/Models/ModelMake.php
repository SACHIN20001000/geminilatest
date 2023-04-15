<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMake extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'make_id'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function makes()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }
    public function makeModels()
    {
        return $this->hasMany(MakeModel::class, 'make_id', 'id');
    }
    public function getMakes($make, $type)
    {
        $data = MakeModel::where(['make_id' => $make, 'type' => $type])->first();
        if ($data) {
            return $data->name;
        }
    }
}
