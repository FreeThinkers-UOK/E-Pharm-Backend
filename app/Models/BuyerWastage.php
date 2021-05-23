<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerWastage extends Model
{
    use HasFactory;

    protected $table = 'buyerwastages';
    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'buyer_order_id',
        'wastage_quantity',
        'created_by',
        'wastage_image',
    
    ];

    public function buyerorder()
    {
        return $this->belongsTo('App\Models\BuyerOrder');
    }
  
    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer');
    }
}
