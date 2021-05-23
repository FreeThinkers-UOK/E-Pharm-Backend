<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ApiBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }
    public function sendMultipleResponse($result,$result2, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'Total'   =>$result2,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }
    public function sendResponseNoData($message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}