<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable=['user_id','holder_name','phone','email','insurance_id','product_id','subproduct_id','attachment_id','remark','assigned	','status','quote_id'];
    
}
