<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    public static function rollback($e, $message = 'Something went wrong! Process not completed.')
    {
        DB::rollback();
        self::throwError($e, $message);
    }

    public static function throwError($e, $message = 'Something went wrong! Process not completed.')
    {
        Log::info($e);
        throw new HttpResponseException(response()->json([
            'message' => $message,
        ], 500));
    }

    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

}
