<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
       /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result)
    {

       $response = [
            'data' => $result['data'],
            'success' => true,
            'status' => 200,
            'message' => $result['message']
        ];

        return response()->json($response, 200);
    }

    public function apiResponse($keyString, $result){
        switch ($keyString) {
            case 'success':
                return $this->sendResponse($result);
                break;

            case 'error':
                return $this->sendError($result);
                break;

            default:
                return $this->sendError($result);
                break;
        }
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error)
    {
    	$response = [
            'data' => $error['data'],
            'success' => false,
            'message' => $error['message'],
            'status' => $error['status']
        ];

        return response()->json($response, $error['status']);
    }
}
