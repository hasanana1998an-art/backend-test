<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'order_id', 'company_name', 'tracking_no', 'status', 'estimated_delivery'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
