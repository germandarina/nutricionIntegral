<div class="page">
    <h3 style="text-align: center; background-color: {!! $color_days !!}; padding: 3px; font-size: 30px!important;">DÍA {{ $day }}</h3>
    @foreach($details_by_day as $j => $detail)
        <h3>{{ strtoupper(\App\Models\PlanDetail::$types[$detail->order_type]) }} - {{ strtoupper($detail->recipe->name) }}
        @if($macros)
            <span class="macros">
                <br>
                Energia (kcal): {{ number_format($detail->recipe->total_energia_kcal,3,',','.')  }}
                - Protéina (g): {{ number_format($detail->recipe->total_proteina,3,',','.') }}
                - Carbohidratos (g): {{ number_format($detail->recipe->total_carbohidratos_totales,3,',','.') }}
                - Grasa (g): {{ number_format($detail->recipe->total_grasa_total,3,',','.') }}
            </span>
        @endif
        </h3>
        <div>
            <table>
                <thead>
                <tr>
                    <th style="background-color: {!! $color_headers !!}; padding: 3px;">INGREDIENTES</th>
                    <th style="background-color: {!! $color_headers !!}; padding: 3px;">CANTIDADES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($detail->recipe->ingredients as $ingredient)
                    <tr>
                        <td style="text-align: left; padding: 3px;">{{$ingredient->food->name}}</td>
                        <td style="text-align: left; padding: 3px;">{{$ingredient->quantity_description}} ({{ number_format($ingredient->quantity_grs,3,',','.') }} grs)</td>
                    </tr>
                @endforeach
                </tbody>
                @if($detail->observations->isNotEmpty())
                    <tfoot>
                    <tr>
                        <td style="text-align: left;background-color: {!! $color_observations !!}; padding: 3px;" colspan="2"><strong>OBSERVACIONES: {{ implode('. ', $detail->observations->pluck('name')->toArray() ) }}</strong></td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    @endforeach
</div>

