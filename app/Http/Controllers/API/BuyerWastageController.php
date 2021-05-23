<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use Illuminate\Http\Request;
use App\Models\BuyerWastage;
use App\Models\BuyerOrder;
use Validator;
use Auth;
use App\Http\Resources\BuyerWastage as BuyerWastageResource;

class BuyerWastageController extends ApiBaseController
{
    public function index()
    {
        $buyerwastages = BuyerWastage::all();
        $user=Auth::user()->id;
        return $this->sendResponse(BuyerWastageResource::collection($buyerwastages), 'Buyer Wastages retrieved successfully.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
       // $user=Auth::user()->id;
        $validator = Validator::make($input, [
            'buyer_order_id' => 'required',
            'wastage_image'    =>'required',
            'quantity' =>'required',
            'created_by' =>'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
            $buyerwastage = new BuyerWastage();
            $buyerwastage->buyer_order_id=$request->input('buyer_order_id');
            $buyerwastage->wastage_quantity=$request->input('buyer_quantity');
            $buyerwastage->created_by=$request->input('created_by');
            $buyerwastage->wastage_image=$request->input('wastage_image');

            $buyerwastage->save();

   
        return $this->sendResponse([],'Buyer Wastage created successfully.');
    } 
   
    public function show($id)
    {
        $buyerwastage = BuyerWastage::find($id);
  
        if (is_null($buyerwastage)) {
            return $this->sendError('Buyer wastage not found.');
        }
   
        return $this->sendResponse(new BuyerWastageResource($buyerwastage), 'Buyer Wastage retrieved successfully.');
    }
    
    
    public function update(Request $request, $id)
    {
        //dd($id);
        $validator = Validator::make($request->all(),
    [
        'buyer_order_id'=>'required',
        'wastage_quantity'=>'required',
        'createdBy' =>'required',
    ]
    );
    
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
     };
    $buyerwastage = BuyerWastage::findOrFail($id);
    $buyerwastage->buyer_order_id = $request->input('orderDetailsId');
    $buyerwastage->wastage_quantity = $request->input('quantity');
    $buyerwastage->save();
    return $this->sendResponse(new BuyerWastageResource($buyerwastage), 'Buyer Wastage retrieved successfully.');

    }
   
    public function destroy(buyerwastage $buyerwastage)
    {
        $buyerwastage->delete();
   
        return $this->sendResponse([], 'buyer Wastage deleted successfully.');
    }
}
