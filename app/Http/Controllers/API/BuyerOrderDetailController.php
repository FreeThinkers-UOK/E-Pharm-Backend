<?php

namespace App\Http\Controllers\API;
use App\Models\BuyerOrder;
use App\Models\BuyerOrderDetail;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use Illuminate\Http\Request;
use App\Http\Resources\BuyerOrderDetail as BuyerOrderDetailResource;

class BuyerOrderDetailController extends ApiBaseController
{
   
    public function show($id)
    {
        $buyerorder = BuyerOrder::find($id);
        //print_r($buyerorder->buyer_id);
        if (is_null($buyerorder)) {
            return $this->sendError('Buyerorder details not found.');
        }

        return $this->sendResponse(new BuyerOrderDetailResource($buyerorder), 'Buyerorder details retrieved successfully.');
    }

}
