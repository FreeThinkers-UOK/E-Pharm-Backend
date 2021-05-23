<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use Illuminate\Http\Request;
use App\Models\SupplierWastage;
use Validator;
use Auth;
use App\Http\Resources\SupplierWastage as SupplierWastageResource;

class SupplierWastageController extends ApiBaseController
{
    public function index()
    {
        $supplierwastage = SupplierWastage::all();
     //   $user=Auth::user()->id;
        return $this->sendResponse(SupplierWastageResource::collection($supplierwastage), 'Supplier Wastages retrieved successfully.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'supplier_order_id' => 'required',
            'supplierWastages' =>'required'
         
        ]);
        
         if($validator->fails()){
             return $this->sendError('Validation Error.', $validator->errors());       
         }
         $supplierwastage=new SupplierWastage; 
         foreach ($request->supplierWastages as $SupplierWastage){ 
           
         $supplierWastageObj=[
             'product_id'       =>$SupplierWastage['product_id'],
             'supplier_order_id'=>$SupplierWastage['supplier_order_id'],
             'wastage_quantity' =>$SupplierWastage['wastage_quantity'],
             'receive_quantity' =>$SupplierWastage['receive_quantity'],   
         ];
        }
        $supplierwastage->insert($supplierWastageObj);
                
        return $this->sendResponseNoData('Supplier wastage details created successfully.');
  
    } 
   
    public function show($id)
    {
        $supplierwastage = SupplierWastage::find($id);
  
        if (is_null($supplierwastage)) {
            return $this->sendError('supplier wastage not found.');
        }
   
        return $this->sendResponse(new SupplierWastageResource($supplierwastage), 'supplier Wastage retrieved successfully.');
    }
    
    
    public function update(Request $request, $id)
    {
        $supplierwastage=SupplierWastage::find($id);
        $validator = Validator::make($request->all(),
    [
        'wastage_quantity'=>'required',
        'receice_quantity'=>'required',
        'product_id'      =>'required',
        'supplier_order_id'=>'required',
    ]
    );
    
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
     };
    $supplierwastage = SupplierWastage::findOrFail($id);
    $supplierwastage->receive_quantity = $request->input('receive_quantity');
    $supplierwastage->supplier_order_id = $request->input('supplier_order_id');
    $supplierwastage->save();
    return $this->sendResponse(new SupplierWastageResource($supplierwastage), 'supplier Wastage retrieved successfully.');

    }
   
    public function destroy($id){
        $supplierwastage = SupplierWastage::find($id);
    
        if  ($supplierwastage->delete()){
            
    
            return $this->sendResponseNoData('supplier wastage details  deleted successfully');
        }
    
        return back()->with('error', "error");
    }

}
