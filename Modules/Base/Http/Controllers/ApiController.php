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
    public function handleResponse($data, $status = 200, $message = 'Success', $header = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ], $status, $header);
    }
}
