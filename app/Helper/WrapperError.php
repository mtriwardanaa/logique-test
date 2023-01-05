<?php

namespace App\Helper;

class WrapperError
{
    public static function error($httpCode, $message = null, $type = 'general', $field = null)
    {
        if ($httpCode === 403) {
            $message = 'API key is missing.';
        }

        if ($httpCode === 401) {
            $message = 'Invalid API key.';
        }

        if ($httpCode === 400) {
            if ($type == 'field' && str_contains($message, 'required')) {
                $message = 'Please provide ' . $field . ' fields.';
            }
        }

        if ($httpCode === 500) {
            $message = 'Something went wrong. Please try again later.';
        }

        $set = [
            'error' => $message,
        ];

        return response()->json($set, $httpCode);
    }
}
