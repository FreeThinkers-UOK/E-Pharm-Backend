<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use Illuminate\Http\Request;
use App\Models\SupplierOrderDetail;
use App\Models\SupplierOrder;
use Validator;
use App\Http\Resources\SupplierOrder as SupplierOrderResource;
use App\Http\Resources\SupplierOrderDetail as SupplierOrderDetailResource;


class SupplierOrderController extends ApiBaseController
{
    public function index()
 {
     $supplierOrders = SupplierOrder::all();
     return $this->sendResponse(SupplierOrderResource::collection($supplierOrders), 'SupplierOrderDetails retrieved successfully.');
 }
    public function store(Request $request)
    {
            $input = $request->all();
        
            $validator = Validator::make($input, [
                'supplierId'                  => 'required',
                'deliveredDate'                 =>'required',
                'paymentOption'                 =>'required'       
                ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
      

            $supplierOrder = SupplierOrder::create([
                'supplier_id'             => $request->input('supplierId'),
                'delivered_date'            =>$request->input('deliveredDate'),
                'payment_option_id'            =>$request->input('paymentOption'),


                ]);
            $validator = Validator::make($input, [
                'supplierOrderDetails'=>'required',
    
                ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            foreach ($request->supplierOrderDetails as $supplierOrderDetail) {
                $supplierOrderDetailObj=[
                        "supplier_order_id"          => $supplierOrder->id,
                        'product_id'                 => $supplierOrderDetail['productId'],
                        'agreed_quantity'            => $supplierOrderDetail['agreedQuantity'],
                        'delivered_quantity'         => $supplierOrderDetail['deliveredQuantity'],
                    ];
                    $supplierOrder->orderDetails()->insert([$supplierOrderDetailObj]);
                }   

            return $this->sendResponseNoData('Supplier Order Details created successfully.');
 } 
 
 public function show($id)
 {
     $supplierOrderDetail = SupplierOrder::find($id);
     if (is_null($supplierOrderDetail)) {
         return $this->sendError('Supplier order  is not found.');
     }

     return $this->sendResponse(new SupplierOrderDetailResource($supplierOrderDetail), 'supplierOrderDetail retrieved successfully.');
 }   
 
    public function update(Request $request, $id)
    {
        $supplierOrder = SupplierOrder::find($id);
        $validator = Validator::make($request->all(), [
            'supplierId'                  => 'required',
            'deliveredDate'                 =>'required' ,
            'paymentOption'       =>'required'


        ]);
        $supplierOrder->delivered_date = $request->input('deliveredDate');
        $supplierOrder->payment_option_id  =$request->input('paymentOption');

        $supplierOrder->save();
        $supplierOrder->orderDetails()->delete();
        foreach ($request->supplierOrderDetails as $supplierOrderDetail) {
                
            $supplierOrderDetailObj=[
                "supplier_order_id"            => $supplierOrder->id,
                'product_id'                 => $supplierOrderDetail['productId'],
                'agreed_quantity'            => $supplierOrderDetail['agreedQuantity'],
                'delivered_quantity'         => $supplierOrderDetail['deliveredQuantity'],
            ];
            $supplierOrder->orderDetails()->insert([$supplierOrderDetailObj]);
        }
    return $this->sendResponse(($supplierOrderDetailObj),'SupplierOrderDetail updated successfully.');
    
}
public function getSupplierInvoice($id)
    {
        $supplierOrder = SupplierOrder::find($id);
        $supplierOrders = $supplierOrder->orderDetails()->get();
        $allSupplierOrders=[];
        foreach($supplierOrders as $supplierOrder)
            {
                $supplierOrderDetail=[
                    "id"=>$supplierOrder->id,
                   "supplierName" =>$supplierOrder->supplierOrder->supplier->user->first_name,
                     "productName"=>$supplierOrder->product()->first()->product_name,
                    "deliveredQuantity"=>$supplierOrder->delivered_quantity,
                    "price"=>$supplierOrder->delivered_quantity*$supplierOrder->product()->first()->price
                    

                ];
                $totalPrice = 0;
            foreach($supplierOrders as $supplierOrder)
            {
                 $subtotal = $supplierOrder->delivered_quantity*$supplierOrder->product->price;
                 $totalPrice += $subtotal;
            }   
                array_push($allSupplierOrders,$supplierOrderDetail); 
            }
        if (is_null($allSupplierOrders)) {
            return $this->sendError('invoice details not found.');
        }
        return $this->sendMultipleResponse(($allSupplierOrders),($totalPrice), 'supplier invoice details retrieved successfully.');
    }

    
}
