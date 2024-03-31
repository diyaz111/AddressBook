<?php

use Illuminate\Support\Str;

if (!function_exists('responder')) {
    function responder(bool $status, $data = null, $code = null, $message = null, $referenceId = null, $timestamp = null)
    {
        return [
            'status' => $status ? 'OK' : 'ERROR',
            'ref_id' => $referenceId,
            'code' => $code,
            'timestamp' => !is_null($timestamp) ? $timestamp->toIso8601String() : now()->toIso8601String(),
            'data' => $data,
            'message' => $message,
        ];
    }
}

if (!function_exists('generateId')) {
    function generateId()
    {
        return (string) Str::orderedUuid();
    }
}

