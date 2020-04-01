<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Error404Controller extends Controller
{
    public function apiResponse(): JsonResponse
    {
        return response()->json(['message' => __('Page not found')], 404);
    }

    public function webResponse(): Response
    {
        return response()->view('errors.404', ['exception' => new HttpException(404)], 404);
    }
}
