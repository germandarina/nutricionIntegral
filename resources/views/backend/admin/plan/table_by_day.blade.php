<h3 style="text-align: center; background-color: lightgrey; padding: 2px;">DÍA {{ $day }}</h3>
@if(isset($array_details_by_day))
    @for ($i = 0; $i <= 1; $i++)
        @foreach($array_details_by_day as $detail_by_day)
            @if(isset($detail_by_day[$i]))
                    @switch(true)
                        @case($i == 0 and $detail_by_day[$i]->planDetail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Desayuno/Merienda'))
                            <h3>DESAYUNO</h3>
                        @break

                        @case($i == 1 and $detail_by_day[$i]->planDetail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Desayuno/Merienda'))
                            <h3>MERIENDA</h3>
                        @break

                        @case($detail_by_day[$i]->planDetail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Colacion'))
                            <h3>COLACIÓN</h3>
                        @break

                        @case($i == 0 and $detail_by_day[$i]->planDetail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Almuerzo/Cena'))
                            <h3>ALMUERZO</h3>
                        @break

                        @case($i == 1 and $detail_by_day[$i]->planDetail->recipe->recipe_type_id == \App\Models\RecipeType::getIdByName('Almuerzo/Cena'))
                            <h3>CENA</h3>
                        @break
                    @endswitch
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">{{ strtoupper($detail_by_day[$i]->planDetail->recipe->name) }}</th>
                            </tr>
                            <tr>
                                <th>INGREDIENTES</th>
                                <th>CANTIDAD</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($detail_by_day[$i]->planDetail->recipe->ingredients as $ingredient)
                            <tr>
                                <td style="text-align: left;">{{$ingredient->food->name}}</td>
                                <td style="text-align: left;">{{$ingredient->quantity_description}} ({{$ingredient->quantity_grs}} grs)</td>
                            </tr>
                        @endforeach
                        </tbody>
                        @if(!empty($detail_by_day[$i]->planDetail->recipe->observation))
                            <tfoot>
                            <tr>
                                <td style="text-align: left;background-color: #b7f55b;"><strong>Observaciones</strong></td>
                                <td style="text-align: left;background-color: #b7f55b;"><strong>{{$detail_by_day[$i]->planDetail->recipe->observation}}</strong></td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
            @endif
        @endforeach
    @endfor
    <div style="page-break-after: always;"></div>
@endif
