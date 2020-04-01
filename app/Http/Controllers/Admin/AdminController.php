<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): RedirectResponse
    {
        // keep alert message with the redirection
        if (session()->has('alert.config')) {
            session()->flash('alert.config', session()->pull('alert.config'));
        }

        return redirect()->route('dashboard.index');
    }
}
