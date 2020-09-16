<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm" style="font-size: 10px;">
            <thead>
                <tr>
                    <th> Total Energia (Kcal)</th>
                    <th> Total Proteínas (g)</th>
                    <th> Total Grasa (g)</th>
                    <th> Total Carbohidratos (g)</th>
                    <th> Total Hierro (mg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{$total['total_energia_kcal'] }}</td>
                    <td style="text-align: center;">{{$total['total_proteina'] }}</td>
                    <td style="text-align: center;">{{$total['total_grasa_total'] }}</td>
                    <td style="text-align: center;">{{$total['total_carbohidratos_totales'] }}</td>
                    <td style="text-align: center;">{{$total['total_hierro'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm" style="font-size: 10px;">
            <thead>
            <tr>
                <th> Total Agua (g)</th>
                <th> Total Cenizas (g)</th>
                <th> Total Sodio (mg)</th>
                <th> Total Potasio (mg)</th>
                <th> Total Calcio (mg)</th>
                <th> Total Fosforo (mg)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center;">{{$total['total_agua'] }}</td>
                <td style="text-align: center;">{{$total['total_cenizas'] }}</td>
                <td style="text-align: center;">{{$total['total_sodio'] }}</td>
                <td style="text-align: center;">{{$total['total_potasio'] }}</td>
                <td style="text-align: center;">{{$total['total_calcio'] }}</td>
                <td style="text-align: center;">{{$total['total_fosforo'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm" style="font-size: 10px;">
            <thead>
            <tr>
                <th> Total Zinc (mg)</th>
                <th> Total Tiamina (mg)</th>
                <th> Total Riboflavina (mg)</th>
                <th> Total Niacina (mg)</th>
                <th> Total Vitamina C (mg)</th>
                <th> Total Carbohidratos Disp (g)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center;">{{$total['total_zinc'] }}</td>
                <td style="text-align: center;">{{$total['total_tiamina'] }}</td>
                <td style="text-align: center;">{{$total['total_riboflavina'] }}</td>
                <td style="text-align: center;">{{$total['total_niacina'] }}</td>
                <td style="text-align: center;">{{$total['total_vitamina_c'] }}</td>
                <td style="text-align: center;">{{$total['total_carbohidratos_disponibles'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm" style="font-size: 10px;">
            <thead>
                <tr>
                    <th> Total Ac Grasos Satu (g)</th>
                    <th> Total Ac Grasos Mono (g)</th>
                    <th> Total Ac Grasos Poli (g)</th>
                    <th> Total Colesterol (mg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{$total['total_ac_grasos_saturados'] }}</td>
                    <td style="text-align: center;">{{$total['total_ac_grasos_monoinsaturados'] }}</td>
                    <td style="text-align: center;">{{$total['total_ac_grasos_poliinsaturados'] }}</td>
                    <td style="text-align: center;">{{$total['total_colesterol'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


