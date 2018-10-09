<?php
/**
 * Created by PhpStorm.
 * User: bugragocer
 * Date: 9.10.2018
 * Time: 17:35
 */

namespace PayLabs\Traits;

Trait ApiResponse
{
    protected function successResponse($message, $http_code)
    {
        return response()->json([
            'result' => true,
            'message' => $message,
        ], $http_code);
    }

    protected function errorResponse($message, $code, $http_code)
    {
        return response()->json([
            'error' => [
                'result' => false,
                'code' => $code,
                'http_code' => $http_code,
                'message' => $message
            ]
        ], $http_code);
    }
}