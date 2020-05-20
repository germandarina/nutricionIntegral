<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm font-xs">
            <thead class="bg-success">
                <tr>
                    <th>Energia (Kcal)</th>
                    <th>Proteínas (g)</th>
                    <th>Grasa (g)</th>
                    <th>Carbohidratos (g)</th>
                    <th>Colesterol (mg)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-secondary">
                    <td style="text-align: center;">{{$food->energia_kcal}}</td>
                    <td style="text-align: center;">{{$food->proteina}}</td>
                    <td style="text-align: center;">{{$food->grasa_total}}</td>
                    <td style="text-align: center;">{{$food->carbohidratos_totales}}</td>
                    <td style="text-align: center;">{{$food->colesterol}}</td>
                    <td style="text-align: center;"><a href="#" class="btn btn-sm btn-success" onclick="getComposicionCompleta({{$food->id}})"><i class="fas fa-eye"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
