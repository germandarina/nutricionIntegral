<h3 style="text-align: center; background-color: lightgrey; padding: 5px;">DÍA {{ $day }}</h3>
@if(isset($details))
    @foreach($details as $j => $detail)
        <div>
            @switch(true)
                @case($j == 0 and $detail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Desayuno/Merienda'))
                    <h3>DESAYUNO</h3>
                @break

                @case(($j == 2 || $j == 3 || $j == 4) and $detail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Desayuno/Merienda'))
                    <h3>MERIENDA</h3>
                @break

                @case(($j == 1 || $j == 3) and $detail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Colacion'))
                    <h3>COLACIÓN</h3>
                @break

                @case(($j == 1 || $j == 2) and $detail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Almuerzo/Cena'))
                    <h3>ALMUERZO</h3>
                @break

                @case(($j == 3 || $j == 4 || $j == 5) and $detail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Almuerzo/Cena'))
                    <h3>CENA</h3>
                @break
            @endswitch
        </div>
        <div>
            <table>
                <thead>
                <tr>
                    <th colspan="2">{{ strtoupper($detail->recipe->name) }}</th>
                </tr>
                <tr>
                    <th>INGREDIENTES</th>
                    <th>CANTIDAD</th>
                </tr>
                </thead>
                <tbody>
                @foreach($detail->recipe->ingredients as $ingredient)
                    <tr>
                        <td style="text-align: left;">{{$ingredient->food->name}}</td>
                        <td style="text-align: left;">{{$ingredient->quantity_description}} ({{$ingredient->quantity_grs}} grs)</td>
                    </tr>
                @endforeach
                </tbody>
                @if(!empty($detail->recipe->observation))
                    <tfoot>
                        <tr>
                            <td style="text-align: left;background-color: #b7f55b;"><strong>Observaciones</strong></td>
                            <td style="text-align: left;background-color: #b7f55b;"><strong>{{$detail->recipe->observation}}</strong></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    @endforeach
    <div style="page-break-after: always;"></div>
@endif
