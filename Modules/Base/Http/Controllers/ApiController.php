<?php

namespace Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;

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
