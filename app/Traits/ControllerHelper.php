<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait ControllerHelper
{
    /**
     * @return \Illuminate\Http\Request
     */
    protected function getRequest()
    {
        if (!isset($this->validation)) {
            return request();
        }

        return resolve($this->validation);
    }

    /**
     * @param object $result
     * @param string $message
     * @param boolean $status
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $status = true)
    {
        return Response::json([
            'data' => $result,
            'message' => $message,
            'status' => $status,
        ]);
    }

    /**
     * @param string $error
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 404)
    {
        return Response::json(['status' => false, 'error' => $error], $code);
    }

    /**
     * @param string $message
     * @param boolean $status
     *
     * @return \Illuminate\Http\Response
     */
    public function sendInfo($message, $status = true)
    {
        return Response::json([
            'status' => $status,
            'message' => $message
        ], 200);
    }
}