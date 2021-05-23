<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierOrder extends Model
{
    use HasFactory;
    protected $table = 'supplier_order';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'supplier_id',
        'delivered_date',
        'payment_option_id'
    
    
    ];

    public function orderDetails()
    {
        return $this->hasMany(SupplierOrderDetail::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }
   public function supplierwastages()
   {
       return $this->hasMany(SupplierWastage::class);
   }
   
}
