<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'buyer_order_details';
    
    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'buyer_order_id',
        'product_id',
        'quantity',
        'total_price'
    ];
    public function buyerorder()
    {
        return $this->belongsTo('App\Models\BuyerOrder');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer');
    }
    public function buyerwastages()
    {
        return $this->hasMany('App\Models\BuyerWastage');
    }

}
