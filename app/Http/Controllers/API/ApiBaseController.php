<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;


class ApiBaseController extends Controller
{

    /**
     * success response method.
     *
     * @params string $message Reply Message
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($message, $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * success response method with payload.
     *
     * @params array $payload Reply Payload
     * @params string $message Reply Message
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendResponseWithPayload($payload, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $payload,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @params string $message  Error message
     * @params array $errorMessages Error Payload
     * @params int $code  Error code
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**
     * return no access error
     *
     * @return \Illuminate\Http\Response
     */

    protected function noAccessAllowed()
    {
        return $this->sendError(__('Access not allowed'), __('Access not allowed'), 403);
    }
}
