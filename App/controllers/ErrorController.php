<?php

namespace App\Controllers;

class ErrorController
{

    public static function notFound($message = 'Resource not found')
    {
        http_response_code(404);
        loadView('error', [
            'status' => 404,
            'message' => $message,
        ]);
    }
}
