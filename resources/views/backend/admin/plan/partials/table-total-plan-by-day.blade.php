
<div class="col-sm-12">
    <table class="table table-responsive-sm table-sm table-condensed font-xs ">
        <thead class="bg-success">
            <tr>
                <th colspan="3" style="text-align: center; border-right: 2px solid white; ">Energia (Kcal)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Proteínas (g)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Grasa (g)</th>
                <th colspan="3" style="text-align: center; border-right: 2px solid white;">Carbohidratos (g)</th>
                <th></th>
            </tr>
            <tr>
                <th style="text-align: center; ">Nec. por día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center; ">Nec. por día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center; ">Nec. por día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center;">Nec. por día </th>
                <th style="text-align: center;">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-secondary">
                <td style="text-align: center;" ><strong>{{ $plan->energia_kcal_por_dia }}</strong></td>
                <td style="text-align: center;"><strong>{{ $total['total_energia_kcal'] }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white; background-color: #fd8584;" ><strong>{{ $plan->energia_kcal_por_dia -  $total['total_energia_kcal'] }}</strong></td>

                <td style="text-align: center;" ><strong>{{ $plan->proteina_por_dia }}</strong></td>
                <td style="text-align: center;"><strong>{{ $total['total_proteina'] }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;" ><strong>{{ $plan->proteina_por_dia -  $total['total_proteina'] }}</strong></td>

                <td style="text-align: center;" ><strong>{{ $plan->carbohidratos_por_dia }}</strong></td>
                <td style="text-align: center;"><strong>{{ $total['total_carbohidratos_totales'] }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;" ><strong>{{ $plan->carbohidratos_por_dia -  $total['total_carbohidratos_totales'] }}</strong></td>

                <td style="text-align: center;" ><strong>{{ $plan->grasa_total_por_dia }}</strong></td>
                <td style="text-align: center;"><strong>{{ $total['total_grasa_total'] }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;" ><strong>{{ $plan->grasa_total_por_dia -  $total['total_grasa_total'] }}</strong></td>

                <td style="text-align: center;"><a title="Ver Total Completo" href="#" class="btn btn-sm btn-primary" onclick="getTotalCompletoPlanPorDia(event,{{$plan->id}},{{$day}})"><i class="fas fa-eye"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>
