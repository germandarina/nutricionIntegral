<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $expiration_day  = (int) config('expiration.expiration_day');
        $year            = (int) date('Y');
        $month           = (int) date('m');
        $expiration_date = Carbon::createFromDate($year,$month,$expiration_day)->startOfDay();
        $today           = Carbon::now()->startOfDay();
        $message         = "";

        if($today->lt($expiration_date) && $today->diffInDays($expiration_date) <= 2)
            $message = "Recuerde que el día {$expiration_day} vence su subscripción. Si Ud. ya abono, desestime este mensaje.";

        if($today->eq($expiration_date))
            $message = "El día de la fecha venció su subscripción. Si Ud ya abono, desestime este mensaje.";

        if($today->gt($expiration_date) && $today->diffInDays($expiration_date) <= 2)
            $message = "La subscripción ya venció. Si Ud ya abono, desestime este mensaje.";

        return view('backend.dashboard',compact('message'));
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
