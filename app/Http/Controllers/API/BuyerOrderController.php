<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use App\Models\BuyerOrder;
use App\Models\BuyerOrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Http\Resources\BuyerOrder as BuyerOrderResource;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class BuyerOrderController extends ApiBaseController
{

    // public function calculateTotalPrice($quantity, $priceunit)
    // {
    //      $truck_price    = Config::get('nfc_constant_values.truck_price');
    //      $handling_price = Config::get('nfc_constant_values.handling_price');
    //      $shipping_price = Config::get('nfc_constant_values.shipping_price');

    //     // return $truck_price + $handling_price + $shipping_price + ($quantity * $priceunit);
    //     return ($quantity * $priceunit);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyerOrder = BuyerOrder::all();
      
        return $this->sendResponse(BuyerOrderResource::collection($buyerOrder), 'BuyerOrder retrieved successfully.');
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            "buyerorderdetails"=>'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

      // $user = Auth::user();
     //  dd($user);
//dd(auth('api')->user()->buyer()->first()->id)
        if ($buyerorder = BuyerOrder::create(['buyer_id' =>auth('api')->user()->buyer()->first()->id])){
            foreach($request->buyerorderdetails as $buyerorderdetail){
            $product       = Product::find($buyerorderdetail['productId']);
            $unitprice     = $product->price; 
            //dd($request->buyerorderdetails);
                 $details=[
                    'buyer_order_id' => $buyerorder->id,
                    'product_id'       =>$buyerorderdetail['productId'],
                    'quantity'          =>$buyerorderdetail['quantity'],
                    'price' => $buyerorderdetail['quantity']*$unitprice,
                ];
            //dd($buyerorderdetail['productId']->products()->first()->price);
            $buyerorder->buyerorderdetails()->insert($details);
            }
        }
       // $buyerorder = BuyerOrder::find($buyerorder->id);
        $truck_price    = Config::get('nfc_constant_values.truck_price');
        $handling_price = Config::get('nfc_constant_values.handling_price');
        $shipping_price = Config::get('nfc_constant_values.shipping_price');

        $totalQuantity=DB::table('buyer_order_details')->where('buyer_order_id',$buyerorder->id)->sum('quantity');
        $totlPrice=DB::table('buyer_order_details')->where('buyer_order_id', $buyerorder->id)->sum('price');
        if($totalQuantity==2000 || $totalQuantity<2000){
         $finalPrice= $truck_price + $handling_price + $shipping_price + $totlPrice;
         DB::table('buyer_orders')->where('id',$buyerorder->id)->update(['total_price'=> $finalPrice]);
        }
        elseif($totalQuantity%2000 == 0){
            $truck_price=intdiv($totalQuantity, 2000)*3500;
          $finalPrice= $truck_price + $handling_price + $shipping_price + $totlPrice;
          DB::table('buyer_orders')->where('id',$buyerorder->id)->update(['total_price' =>$finalPrice]);
        }
        elseif($totalQuantity>2000){
            $price1=intdiv($totalQuantity, 2000)*3500;
            $price2= ($totalQuantity%2000)*3500;
            $truck_price=$price1+$price2;
            $finalPrice= $truck_price + $handling_price + $shipping_price + $totlPrice;
            DB::table('buyer_orders')->where('id',$buyerorder->id)->update('total_price',$finalPrice);

        }
        

        return $this->sendResponse(($buyerorder),'Buyer Order created successfully.');
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuyerOrder  $buyerOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $buyerorder = BuyerOrder::find($id);
       $buyerorderdetails = $buyerorder->buyerorderdetails()->get();
        // $sbuyerorderdetails= BuyerOrder::find($id);
        //dd($sbuyerorderdetails);
        $validator = Validator::make($request->all(), [
            "buyerOrderDetails"=>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $buyerorder->buyerorderdetails()->delete();
            foreach($request->buyerOrderDetails as $buyerorderdetail){
            $product       = Product::find($buyerorderdetail['productId']);
            $unitprice     = $product->price; 
          //  dd($product );
                 $details=[
                     'buyer_order_id'   =>  $buyerorder->id,
                    'product_id'        =>$buyerorderdetail['productId'],
                    'quantity'         =>$buyerorderdetail['quantity'],
                   'price'  => $buyerorderdetail['quantity']*$unitprice
                ];
            $buyerorder->buyerorderdetails()->insert($details);
        
        }
            return $this->sendResponse(new BuyerOrderResource($buyerorder), 'Buyer Order updated successfully.');
        
    }

     
}
