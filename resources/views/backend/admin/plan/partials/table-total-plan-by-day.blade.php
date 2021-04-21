@php
  $resto_energia    = $plan->energia_kcal_por_dia -  $total['total_energia_kcal'];
  $resto_proteina   = $plan->proteina_por_dia -  $total['total_proteina'];
  $resto_grasa      = $plan->grasa_total_por_dia -  $total['total_grasa_total'];
  $resto_carbos     = $plan->carbohidratos_por_dia -  $total['total_carbohidratos_totales'];
@endphp
<div class="col-sm-12">
    <table class="table table-responsive-sm table-sm table-condensed font-xs ">
        <thead >
            <tr class="bg-dark">
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Energia (kcal)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Proteínas (g)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Grasa (g)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Carbohidratos (g)</th>
                <th></th>
            </tr>
            <tr>
                <th style="text-align: center;" class="bg-info">Nec. por Día </th>
                <th style="text-align: center;" class="bg-info">Cargada</th>
                @if($resto_energia >= 0)
                    <th class="bg-success" style="text-align: center; border-right: 2px solid white;">Faltante</th>
                @else
                    <th class="bg-danger" style="text-align: center; border-right: 2px solid white;">Excedido</th>
                @endif

                <th style="text-align: center; " class="bg-info">Nec. por Día </th>
                <th style="text-align: center; " class="bg-info">Cargada</th>
                @if($resto_proteina >= 0)
                    <th class="bg-success" style="text-align: center; border-right: 2px solid white;">Faltante</th>
                @else
                    <th class="bg-danger" style="text-align: center; border-right: 2px solid white;">Excedido</th>
                @endif

                <th style="text-align: center; " class="bg-info">Nec. por Día </th>
                <th style="text-align: center; " class="bg-info">Cargada</th>
                @if($resto_grasa >= 0)
                    <th class="bg-success" style="text-align: center; border-right: 2px solid white;">Faltante</th>
                @else
                    <th class="bg-danger" style="text-align: center; border-right: 2px solid white;">Excedido</th>
                @endif

                <th style="text-align: center;" class="bg-info">Nec. por Día </th>
                <th style="text-align: center;" class="bg-info">Cargada</th>
                @if($resto_carbos >= 0)
                    <th class="bg-success" style="text-align: center; border-right: 2px solid white;">Faltante</th>
                @else
                    <th class="bg-danger" style="text-align: center; border-right: 2px solid white;">Excedido</th>
                @endif

                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;"><strong>{{ number_format($plan->energia_kcal_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_energia_kcal'],3,',','.') }}</strong></td>
                @if($resto_energia >= 0)
                    <td class="bg-success" style="text-align: center; border-right: 2px solid white;" ><strong>{{ number_format($resto_energia,3,',','.') }}</strong></td>
                @else
                    <td class="bg-danger" style="text-align: center; border-right: 2px solid white;" ><strong>{{ number_format($resto_energia,3,',','.') }}</strong></td>
                @endif


                <td style="text-align: center;"><strong>{{ number_format($plan->proteina_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_proteina'],3,',','.') }}</strong></td>

                @if($resto_proteina >= 0)
                    <td class="bg-success" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_proteina,3,',','.') }}</strong></td>
                @else
                    <td class="bg-danger" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_proteina,3,',','.') }}</strong></td>
                @endif


                <td style="text-align: center;"><strong>{{ number_format($plan->grasa_total_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_grasa_total'],3,',','.') }}</strong></td>

                @if($resto_grasa >= 0)
                    <td class="bg-success" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_grasa,3,',','.') }}</strong></td>
                @else
                    <td class="bg-danger" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_grasa,3,',','.') }}</strong></td>
                @endif




                <td style="text-align: center;"><strong>{{ number_format($plan->carbohidratos_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_carbohidratos_totales'],3,',','.') }}</strong></td>
                @if($resto_carbos >= 0)
                    <td class="bg-success" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_carbos,3,',','.') }}</strong></td>
                @else
                    <td class="bg-danger" style="text-align: center; border-right: 2px solid white; "><strong>{{ number_format($resto_carbos,3,',','.') }}</strong></td>
                @endif

                <td style="text-align: center;"><a title="Total Completo" href="#" class="btn btn-sm btn-primary" onclick="getTotalCompletoPlanPorDia(event,{{$plan->id}},{{$day}})"><i class="fas fa-eye"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>
