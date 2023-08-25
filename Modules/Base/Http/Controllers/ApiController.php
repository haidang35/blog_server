<?php

namespace Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 *
 */
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

    /**
     * @param $data
     * @param $transFields
     * @param $treeKey
     * @return \Illuminate\Support\Collection
     */
    public function formatTranslations(array $data, array $transFields, $treeKey = null): \Illuminate\Support\Collection
    {
        $locale = request()->header(config('client.headers.locale'), config('app.fallback_locale'));
        return collect($data)->map(function($item) use($transFields, $locale, $treeKey){
            foreach($transFields as $field) {
                if($item[$field] && array_key_exists($locale, $item[$field])) {
                    $item[$field] = $item[$field][$locale];
                }else {
                    $item[$field] = null;
                }
            }
            if($treeKey) {
                $item[$treeKey] = $this->formatTranslations($item[$treeKey], $transFields, $treeKey);
            }
            return $item;
        });
    }

    public function formatTranslationsForObject(array $data, array $transFields, $treeKey = null)
    {
        $locale = request()->header(config('client.headers.locale'), config('app.fallback_locale'));
        foreach($transFields as $field) {
            if($data[$field] && array_key_exists($locale, $data[$field])) {
                $data[$field] = $data[$field][$locale];
            }else {
                $data[$field] = null;
            }
        }
        return $data;
    }
}
