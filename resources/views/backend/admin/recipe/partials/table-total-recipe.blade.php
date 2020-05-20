
<div class="col-sm-12">
    <table class="table table-responsive-sm table-sm table-condensed font-xs ">
        <thead class="bg-success">
            <tr>
                <th style="text-align: center;">Total Energia (Kcal)</th>
                <th style="text-align: center;">Total Proteínas (g)</th>
                <th style="text-align: center;">Total Grasa (g)</th>
                <th style="text-align: center;">Total Carbohidratos (g)</th>
                <th style="text-align: center;">Total Colesterol (mg)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-secondary">
                <td style="text-align: center;"><strong>{{$recipe->total_energia_kcal}}</strong></td>
                <td style="text-align: center;"><strong>{{$recipe->total_proteina}}</strong></td>
                <td style="text-align: center;"><strong>{{$recipe->total_grasa_total}}</strong></td>
                <td style="text-align: center;"><strong>{{$recipe->total_carbohidratos_totales}}</strong></td>
                <td style="text-align: center;"><strong>{{$recipe->total_colesterol}}</strong></td>
                <td style="text-align: center;"><a href="#" class="btn btn-sm btn-success" onclick="getTotalCompleto(event,{{$recipe->id}})"><i class="fas fa-eye"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>
