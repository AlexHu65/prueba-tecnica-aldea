<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BaseController extends Controller
{
    /**
     * Return success response to parent controller
     * @access public
     * @param string $message message to show on response
     * @param array \Illuminate\Contracts\Support\Arrayable\JsonSerializable $result 
     * @param Array $pagination
     * @return \Illuminate\Http\Response
     */

     protected function success($message, $result, $pagination = []) : JsonResponse{

        $response = [
            'msg' => $message,
            'status'    => true,
            'data' => $result,
        ];

        if(count($pagination) > 0){
            $response['pagination'] = $pagination;
        }

        return response()->json($response, 200);
    }

    /**
     * Return eror response to parent controller
     * @access public
     * @param array \Exception $error
     * @param array $errorMessages error messages to show on response
     * @param int http code response $code
     * @return \Illuminate\Http\Response 
    */

    protected function error($error, $errorMessages = [], $exceptions = [], $code = 404) : JsonResponse{
    	
        $response = [
            'msg' => $error,
            'status' => false,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        if(!empty($exceptions)){
            $response['data'] = $exceptions;
        }

        return response()->json($response, $code);
    }

    protected function paginated($categorized){
        return  [
            'from' => $categorized->firstItem(),
            'to' => $categorized->lastItem(),
            'current_page' => $categorized->currentPage(),
            'per_page' => $categorized->perPage(),
            'last_page' => $categorized->lastPage(),
            'total' => $categorized->total(),
            'info' => 'Showing ' . $categorized->firstItem() . ' - '. $categorized->lastItem() .' of ' . $categorized->total() .' elements.'
        ];
    }
}
