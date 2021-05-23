<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ApiBaseController as ApiBaseController;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\User;
use App\Http\Resources\Buyer as BuyerResource;
use App\Http\Resources\UserResource;
use Validator;



class BuyerController extends ApiBaseController
{
   //show all buyers
    public function index()
    {
        $buyers = Buyer::all();
        return $this->sendResponse(BuyerResource::collection($buyers), 'Buyers retrieved successfully.');
    }
  
    public function show($id)
    {
         $buyer = Buyer::find($id);
         if (is_null($buyer)) {
            return $this->sendError('Buyer not found.');
        }
        return $this->sendResponse((new BuyerResource($buyer)), 'Buyer retrieved successfully.');
    }



}

