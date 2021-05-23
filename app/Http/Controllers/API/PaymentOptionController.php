<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use App\Models\PaymentOption;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentOption as PaymentOptionResource;

class PaymentOptionController extends ApiBaseController
{
      //showing all payment options
   public function index(){
    $allPaymentOptions=PaymentOption::all();
    return $this->sendResponse(PaymentOptionResource::collection($allPaymentOptions), 'Payment options  retrieved successfully.');
 }

 //showing payment option
 public function show($id){
    
    $paymentOption=PaymentOption::find($id);
    if(is_null($paymentOption)){
        return $this->sendError("payment option  is not found");
    }
    return $this->sendResponse(new PaymentOptionResource($paymentOption), 'Payment option  retrieved successfully.');
   }
}
