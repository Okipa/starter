<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): RedirectResponse
    {
        // Keep alert message when redirected.
        session()->keep('alert.config');

        return redirect()->route('dashboard.index');
    }
}
