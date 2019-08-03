<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\Auth\AuthHelper;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->guest()){
            return redirect('/login');
        } else {
            return redirect('/admin/dashboard');
        }
    }
}
