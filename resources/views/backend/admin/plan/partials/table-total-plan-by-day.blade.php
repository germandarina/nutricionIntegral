
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
                <th style="text-align: center; ">Nec. por Día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center; ">Nec. por Día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center; ">Nec. por Día </th>
                <th style="text-align: center; ">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th style="text-align: center;">Nec. por Día </th>
                <th style="text-align: center;">Cargada</th>
                <th style="text-align: center; border-right: 2px solid white;">Faltante</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-secondary">
                <td style="text-align: center;"><strong>{{ number_format($plan->energia_kcal_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_energia_kcal'],3,',','.') }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white; background-color: #fd8584;" ><strong>{{ number_format($plan->energia_kcal_por_dia -  $total['total_energia_kcal'],3,',','.') }}</strong></td>

                <td style="text-align: center;"><strong>{{ number_format($plan->proteina_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_proteina'],3,',','.') }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;"><strong>{{ number_format($plan->proteina_por_dia -  $total['total_proteina'],3,',','.') }}</strong></td>

                <td style="text-align: center;"><strong>{{ number_format($plan->grasa_total_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_grasa_total'],3,',','.') }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;"><strong>{{ number_format($plan->grasa_total_por_dia -  $total['total_grasa_total'],3,',','.') }}</strong></td>

                <td style="text-align: center;"><strong>{{ number_format($plan->carbohidratos_por_dia,3,',','.') }}</strong></td>
                <td style="text-align: center;"><strong>{{ number_format($total['total_carbohidratos_totales'],3,',','.') }}</strong></td>
                <td style="text-align: center; border-right: 2px solid white;  background-color: #fd8584;"><strong>{{ number_format($plan->carbohidratos_por_dia -  $total['total_carbohidratos_totales'],3,',','.') }}</strong></td>
                <td style="text-align: center;"><a title="Total Completo" href="#" class="btn btn-sm btn-primary" onclick="getTotalCompletoPlanPorDia(event,{{$plan->id}},{{$day}})"><i class="fas fa-eye"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>
