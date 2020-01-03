<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FallbackController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notFound()
    {
        $exception = new HttpException(404);

        return view('errors.default', compact('exception'));
    }
}
