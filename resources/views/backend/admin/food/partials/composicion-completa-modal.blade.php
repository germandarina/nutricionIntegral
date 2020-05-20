<div class="row">
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm" style="font-size: 10px;">
            <thead>
                <tr>
                    <th>Energia (Kj)</th>
                    <th>Energia (Kcal)</th>
                    <th>Proteínas (g)</th>
                    <th>Grasa (g)</th>
                    <th>Carbohidratos (g)</th>
                    <th>Hierro (mg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;" >{{$food->energia_kj}}</td>
                    <td style="text-align: center;">{{$food->energia_kcal}}</td>
                    <td style="text-align: center;">{{$food->proteina}}</td>
                    <td style="text-align: center;">{{$food->grasa_total}}</td>
                    <td style="text-align: center;">{{$food->carbohidratos_totales}}</td>
                    <td style="text-align: center;">{{$food->hierro}}</td>
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
                <th>Agua (g)</th>
                <th>Cenizas (g)</th>
                <th>Sodio (mg)</th>
                <th>Potasio (mg)</th>
                <th>Calcio (mg)</th>
                <th>Fosforo (mg)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center;" >{{$food->agua}}</td>
                <td style="text-align: center;">{{$food->cenizas}}</td>
                <td style="text-align: center;">{{$food->sodio}}</td>
                <td style="text-align: center;">{{$food->potasio}}</td>
                <td style="text-align: center;">{{$food->calcio}}</td>
                <td style="text-align: center;">{{$food->fosforo}}</td>
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
                <th>Zinc (mg)</th>
                <th>Tiamina (mg)</th>
                <th>Rivoflavina (mg)</th>
                <th>Niacina (mg)</th>
                <th>Vitamina C (mg)</th>
                <th>Carbohidratos Disp (g)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center;" >{{$food->zinc}}</td>
                <td style="text-align: center;">{{$food->tiamina}}</td>
                <td style="text-align: center;">{{$food->rivoflavina}}</td>
                <td style="text-align: center;">{{$food->niacina}}</td>
                <td style="text-align: center;">{{$food->vitamina_c}}</td>
                <td style="text-align: center;">{{$food->carbohidratos_disponibles}}</td>
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
                    <th>Ac Grasos Satu (g)</th>
                    <th>Ac Grasos Mono (g)</th>
                    <th>Ac Grasos Poli (g)</th>
                    <th>Colesterol (mg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;" >{{$food->ac_grasos_saturados}}</td>
                    <td style="text-align: center;">{{$food->ac_grasos_monoinsaturados}}</td>
                    <td style="text-align: center;">{{$food->ac_grasos_poliinsaturados}}</td>
                    <td style="text-align: center;">{{$food->colesterol}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


