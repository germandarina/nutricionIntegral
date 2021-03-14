<div>
    <h3 style="text-align: center; background-color: lightgrey; padding: 3px;">DÍA {{ $day }}</h3>
    @foreach($details_by_day as $j => $detail)
        <div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="background-color: #a6e6fa;">
                            {{ strtoupper(\App\Models\PlanDetail::$types[$detail->order_type]) }} - {{ strtoupper($detail->recipe->name) }}
                            @if($macros)
                                <br>
                                ( Energia (Kcal): {{ number_format($detail->recipe->total_energia_kcal,3,',','.')  }}
                                - Protéina (G): {{ number_format($detail->recipe->total_proteina,3,',','.') }}
                                - Carbohidratos (G): {{ number_format($detail->recipe->total_carbohidratos_totales,3,',','.') }}
                                - Grasa (G): {{ number_format($detail->recipe->total_grasa_total,3,',','.') }} )
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 50% !important; background-color: #a6e6fa;">INGREDIENTE</th>
                        <th style="width: 50% !important; background-color: #a6e6fa;">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detail->recipe->ingredients as $ingredient)
                    <tr>
                        <td style="text-align: left; padding: 1px; border-bottom: 1px solid black;">{{$ingredient->food->name}}</td>
                        <td style="text-align: center; padding: 1px; border-bottom: 1px solid black;">{{$ingredient->quantity_description}} ({{ number_format($ingredient->quantity_grs,3,',','.') }} grs)</td>
                    </tr>
                @endforeach
                </tbody>
                @if($detail->observations->isNotEmpty())
                    <tfoot>
                    <tr>
                        <td style="text-align: left;background-color: #b7f55b; padding: 1px;" colspan="2"><strong>OBSERVACIONES: {{ implode('. ', $detail->observations->pluck('name')->toArray() ) }}</strong></td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
        <br><br>
    @endforeach
</div>
