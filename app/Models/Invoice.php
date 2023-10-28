<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_Payout', 'short_premium', 'recovery_cases', 'advance_payout', 'adjusted', 'amount_transfer', 'tds', 'invoice_amount', 'name', 'bank_detail', 'transfer_date', 'invoice_date', 'invoice_id', 'policy_id', 'status', 'payment_status'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function policy()
    {
        return $this->hasMany(Policy::class, 'invoice_id', 'id')->where('is_mis', 1);
    }
}
