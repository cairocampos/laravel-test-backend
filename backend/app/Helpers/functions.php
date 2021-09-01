<?php

if(!function_exists('server_error')) {
    function server_error() {
        return response()->json([
            'message' => trans('form.server_error'),
        ], 500);
    }
}

if(!function_exists('not_found')) {
    function not_found() {
        return response()->json([
            'message' => trans('form.not_found'),
        ], 404);
    }
}