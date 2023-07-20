<?php

namespace Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * @param $data
     * @param $status
     * @param $message
     * @param $header
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleResponse($data = null, $status = 200, $message = 'Success', $header = []): \Illuminate\Http\JsonResponse
    {
        if(!$data && $status == 200) {
            return response()->json([
                'message' => 'Error',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR, $header);
        }

        if(!$data) {
            return response()->json([
                'message' => $message,
                'status' => $status
            ], $status, $header);
        }

        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ], $status, $header);
    }
}
