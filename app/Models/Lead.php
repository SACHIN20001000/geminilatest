<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable=['user_id','user_type','holder_name','phone','email','insurance_id','product_id','subproduct_id','attachment_id','remark','assigned	','status','quote_id','mark_read'];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assigns()
    {
        return $this->belongsTo(User::class, 'assigned');
    }
    public function insurances()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'subproduct_id');
    }
    public function policy()
    {
        return $this->hasOne(Policy::class, 'lead_id','id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'lead_id','id');
    }
    public function quotes()
    {
        return $this->hasMany(Quote::class, 'lead_id','id');
    }
   
}
