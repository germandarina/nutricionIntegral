<div class="row">
{{--    <div class="col-sm-12">--}}
{{--        <table class="table table-responsive table-sm font-xs">--}}
{{--            <thead>--}}
{{--                <tr>--}}
{{--                    <th>Gramos:</th>--}}
{{--                    <th>{{ $grs }}</th>--}}
{{--                </tr>--}}
{{--            </thead>--}}
{{--        </table>--}}
{{--    </div>--}}
    <div class="col-sm-12">
        <table class="table table-responsive-sm table-sm font-xs">
            <thead class="bg-success">
                <tr>
                    <th colspan="5" style="text-align: center;">Valores Equivalentes</th>
                </tr>
                <tr>
                    <th style="text-align: center;" >Energia (kcal)</th>
                    <th style="text-align: center;" >Proteínas (g)</th>
                    <th style="text-align: center;" >Grasa (g)</th>
                    <th style="text-align: center;" >Carbohidratos (g)</th>
                    <th style="text-align: center;" >Colesterol (mg)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-secondary">
                    <td style="text-align: center;">{{$eq_energia_kcal}}</td>
                    <td style="text-align: center;">{{$eq_proteina}}</td>
                    <td style="text-align: center;">{{$eq_grasa_total}}</td>
                    <td style="text-align: center;">{{$eq_carbohidratos_totales}}</td>
                    <td style="text-align: center;">{{$eq_colesterol}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
