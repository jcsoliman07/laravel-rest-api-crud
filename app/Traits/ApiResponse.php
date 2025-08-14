<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    public static function rollback($e, $message = 'Something went wrong! Process not completed.', $code = 500)
    {
        DB::rollback();
        self::throwError($e, $message, $code);
    }

    public static function throwError($e, $message = 'Something went wrong! Process not completed.', $code = 500)
    {
        Log::error($e);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message,
            'code'  => $code,
        ], $code));
    }

    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'code'  => $code,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

}
