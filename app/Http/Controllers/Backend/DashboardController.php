<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Session;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    public function downloadManual()
    {
        if(!auth()->user()->isAdmin())
        {
            Session::flash('error','No tiene permiso para realizar esta acción');
            return redirect('/');
        }

        if(!file_exists(public_path('manual/MANUAL_DIAITA.docx')))
        {
            Session::flash('error','No se encontró el archivo');
            return redirect('/');
        }


        return response()->download(public_path('/manual/MANUAL_DIAITA.docx'));
    }
}
