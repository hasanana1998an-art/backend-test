<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'payment_method', 'payment_status', 'transaction_id', 'amount', 'paid_at','user_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
