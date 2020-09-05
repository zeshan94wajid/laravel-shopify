<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * <p> Returns a json success response</p>
     *
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse($result,$message)
    {
        $response=[
            'success'=> true,
            'message'=> $message,
            'data' => $result
        ];
        return response()->json($response,200);
    }

    /**
     * <p> Returns a json error response </p>
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($error,$errorMessages=[],$code=404)
    {
        $response=[
            'success'=> false,
            'message'=> $error
        ];

        if (!empty($errorMessages)) {
            $response['data']=$errorMessages;
        }
        return response()->json($response,$code);
    }
}
