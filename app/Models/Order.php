<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'product_id',
        'buyer_id',
        'quantity',
        
        
    
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer');
    }
    public function BuyerWastage()
    {
        return $this->hasOne('App\Models\BuyerWastage');
    }
}
