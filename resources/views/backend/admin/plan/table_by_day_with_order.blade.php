<hr>
    <h2 style="text-align: center; background-color: lightgrey; padding: 5px;">DÍA {{ $day }}</h2>
<hr>
@if(isset($details_days))
    @foreach($details_days as $j => $detail)
    <div>
        @switch(true)
            @case($j == 0 and $detail->planDetail->recipe->recipe_type_id == 1)
                <h3>DESAYUNO</h3>
            @break

            @case(($j == 2 || $j == 3 || $j == 4) and $detail->planDetail->recipe->recipe_type_id == 1)
                <h3>MERIENDA</h3>
            @break

            @case(($j == 1 || $j == 3) and $detail->planDetail->recipe->recipe_type_id == 3)
                <h3>COLACIÓN</h3>
            @break

            @case(($j == 1 || $j == 2) and $detail->planDetail->recipe->recipe_type_id == 2)
                <h3>ALMUERZO</h3>
            @break

            @case(($j == 3 || $j == 4 || $j == 5) and $detail->planDetail->recipe->recipe_type_id == 2)
                <h3>CENA</h3>
            @break
        @endswitch
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <th colspan="2">{{ strtoupper($detail->planDetail->recipe->name) }}</th>
            </tr>
            <tr>
                <th>INGREDIENTES</th>
                <th>CANTIDAD</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detail->planDetail->recipe->ingredients as $ingredient)
                <tr>
                    <td style="text-align: left;">{{$ingredient->food->name}}</td>
                    <td style="text-align: left;">{{$ingredient->quantity_description}} ({{$ingredient->quantity_grs}} grs)</td>
                </tr>
            @endforeach
            </tbody>
            @if(!empty($detail->planDetail->recipe->observation))
                <tfoot>
                    <tr>
                        <td style="text-align: left;background-color: #b7f55b;"><strong>Observaciones</strong></td>
                        <td style="text-align: left;background-color: #b7f55b;"><strong>{{$detail->planDetail->recipe->observation}}</strong></td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
@endforeach
@endif
