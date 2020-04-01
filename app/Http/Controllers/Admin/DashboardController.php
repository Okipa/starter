<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        SEOTools::setTitle(__('Dashboard'));

        return view('templates.admin.dashboard.index');
    }
}
