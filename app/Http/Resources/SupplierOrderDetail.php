<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierOrderDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {
        $supplierOrderDetails=$this->orderDetails->map(function($product) {
            return [ 
                'productId'=> $product->product_id,
                'productName'=> $product->product()->first()->product_name,
                'agreedQuantity'=> $product->agreed_quantity,
                'deliveredQuantity'=>$product->delivered_quantity
            ];
        
        });
        
        $suppliers=[
            "id"=>$this->supplier_id,
            "name"=>$this->supplier->user->first_name
        ];
        $paymentOption=[
            "id"=>$this->payment_option_id,
            "name"=>$this->paymentOption()->first()->type,
        ];
        return [
            'id' => $this->id,
            'supplierDetails'=>$suppliers,
            'supplierOrderDetails'=>$supplierOrderDetails,
            'deliveredDate'=>$this->delivered_date,
            'paymentOption'=>$paymentOption
        ];
    }
}
