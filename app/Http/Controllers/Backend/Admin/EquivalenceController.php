<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ManageAdminRequest;
use Carbon\Carbon;
use JsValidator;
use Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Food;

/**
 * Class EquivalenceController.
 */
class EquivalenceController extends Controller
{

    public function index(ManageAdminRequest $request)
    {
        return view('backend.admin.equivalence.index');
    }

    public function calculate(ManageAdminRequest $request)
    {
        if($request->input('equivalence_id'))
        {
            $quantity_grs   = request('quantity');
            $food           = Food::find(request('equivalence_id'));

            $eq_energia_kcal = $food->energia_kcal > 0 ? round((($quantity_grs * $food->energia_kcal) / 100), 3) : 0;
            $eq_proteina     = $food->proteina > 0 ? round((($quantity_grs * $food->proteina) / 100), 3) : 0;
            $eq_grasa_total  = $food->grasa_total > 0 ? round((($quantity_grs * $food->grasa_total) / 100), 3) : 0;
            $eq_carbohidratos_totales = $food->carbohidratos_totales > 0 ? round((($quantity_grs * $food->carbohidratos_totales) / 100), 3) : 0;
            $eq_colesterol = $food->colesterol > 0 ? round((($quantity_grs * $food->colesterol) / 100), 3) : 0;

//            $equivalence           = Food::find(request('equivalence_id'));
//
//            $grs_energia     = $equivalence->energia_kcal > 0 ? round((( $total_energia_kcal / $equivalence->energia_kcal ) * 100),3) : 0;
//            $grs_proteina    = $equivalence->proteina > 0 ? round((( $total_proteina / $equivalence->proteina ) * 100),3) : 0;
//            $grs_grasa       = $equivalence->grasa_total > 0 ? round((( $total_grasa_total / $equivalence->grasa_total ) * 100),3) : 0;
//            $grs_carbos      = $equivalence->carbohidratos_totales > 0 ? round((( $total_carbohidratos_totales / $equivalence->carbohidratos_totales ) * 100),3) : 0;
//            $grs_colesterol  = $equivalence->colesterol > 0 ? round((( $total_colesterol / $equivalence->colesterol ) * 100),3) : 0;
//
//            $grs = round(($grs_energia + $grs_proteina + $grs_grasa + $grs_carbos + $grs_colesterol) / 5,3);
//
//            $eq_energia_kcal = $equivalence->energia_kcal > 0 ? round((($grs * $equivalence->energia_kcal) / 100), 3) : 0;
//            $eq_proteina     = $equivalence->proteina > 0 ? round((($grs * $equivalence->proteina) / 100), 3) : 0;
//            $eq_grasa_total  = $equivalence->grasa_total > 0 ? round((($grs * $equivalence->grasa_total) / 100), 3) : 0;
//            $eq_carbohidratos_totales = $equivalence->carbohidratos_totales > 0 ? round((($grs * $equivalence->carbohidratos_totales) / 100), 3) : 0;
//            $eq_colesterol = $equivalence->colesterol > 0 ? round((($grs * $equivalence->colesterol) / 100), 3) : 0;


            return view('backend.admin.equivalence.partials.table-equivalence', compact('eq_energia_kcal', 'eq_proteina',
                'eq_grasa_total', 'eq_carbohidratos_totales', 'eq_colesterol'));
        }
    }
}
