<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm">
            <thead>
                <tr>
                    <th>Energia (Kj)</th>
                    <th>Energia (Kcal)</th>
                    <th>Proteínas (g)</th>
                    <th>Grasa Total (g)</th>
                    <th>Carbohidratos Totales (g)</th>
                    <th>Composicion Completa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;" >{{$food->energia_kj}}</td>
                    <td style="text-align: center;">{{$food->energia_kcal}}</td>
                    <td style="text-align: center;">{{$food->proteina}}</td>
                    <td style="text-align: center;">{{$food->grasa_total}}</td>
                    <td style="text-align: center;">{{$food->carbohidratos_totales}}</td>
                    <td style="text-align: center;"><a href="#" class="btn btn-sm btn-success" onclick="getComposicionCompleta({{$food->id}})"><i class="fas fa-eye"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
