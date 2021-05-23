<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    use HasFactory;
    protected $table = 'payment_option';

    protected $guarded = [
        'id',
    ];
    protected $fillable = [
        'payment_type',
    ];



    public function supplierOrder()
    {
        return $this->hasMany(SupplierOrder::class);
    }
}
