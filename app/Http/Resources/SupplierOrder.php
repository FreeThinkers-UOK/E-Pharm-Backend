<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierOrder extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $supplier=[
            "id"=>$this->supplier_id,
            "name"=>$this->supplier->user->first_name
        ];
        $paymentOption=[
            "id"=>$this->payment_option_id,
            "name"=>$this->paymentOption()->first()->type,
        ];
        return [
        
            'id' => $this->id,
            'supplier'=>$supplier,
            'deliveredDate'=>$this->delivered_date,
            'paymentStatus'=>$paymentOption


        ];
    }
}
