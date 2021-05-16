<div class="page">
    <h3 style="text-align: center; border-bottom: 3px solid {!! $color_days !!}; color: {!! $color_days !!}; padding: 3px; font-size: 30px!important;">{{ $description_day }}</h3>
    <br>
    @foreach($details_by_day as $j => $detail)
        <div>
            <table style="width: 100%; border: 1px solid {!! $color_headers !!};">
                <thead style="display: table-header-group;">
                    <tr>
                        <th colspan="2" style="background-color: white; text-align: left; word-wrap: break-word; width: 65%;">
                           {{ strtoupper(\App\Models\PlanDetail::$types[$detail->order_type]) }} - {{ "Rinde: {$detail->recipe->portions} porción/es - Consumir: {$detail->portions} porción/es" }}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: left; background-color: white;">
                            <span style="display: inline">
                                {{ strtoupper(trim($detail->recipe->name)) }}
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <th style="background-color: {!! $color_headers !!}; padding: 3px; width: 65%;">INGREDIENTES</th>
                        <th style="background-color: {!! $color_headers !!}; padding: 3px; width: 35%;">CANTIDADES</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detail->recipe->ingredients as $ingredient)
                    <tr style="page-break-inside: avoid;">
                        <td style="text-align: left; padding: 3px; width: 65%;">{{$ingredient->food->name}}</td>
                        <td style="text-align: left; padding: 3px; width: 35%;">{{$ingredient->quantity_description}} ({{ number_format($ingredient->quantity_grs,2,',','.') }} grs)</td>
                    </tr>
                @endforeach
                </tbody>
                @if($detail->observations->isNotEmpty() || $macros)
                    <tfoot style="display: table-row-group;">
                        @if($detail->observations->isNotEmpty())
                            <tr>
                                <td style="text-align: left;background-color: {!! $color_observations !!}; padding: 3px;" colspan="2"><strong>OBSERVACIONES: {{ implode('. ', $detail->observations->pluck('name')->toArray() ) }}</strong></td>
                            </tr>
                        @endif
                        @if($macros)
                            <tr>
                                <td style="text-align: left; padding: 3px; border-top: 1px solid {!! $color_headers !!};" colspan="2">
                                    <strong>
                                        Macronutrientes:&nbsp;
                                        Energía (kcal): {{ number_format((($detail->recipe->total_energia_kcal / $detail->recipe->portions) * $detail->portions),3,',','.')  }}
                                        - Proteína (g): {{ number_format((($detail->recipe->total_proteina / $detail->recipe->portions) * $detail->portions),3,',','.') }}
                                        - Carbohidratos (g): {{ number_format((($detail->recipe->total_carbohidratos_totales / $detail->recipe->portions) * $detail->portions),3,',','.') }}
                                        - Grasa (g): {{ number_format((($detail->recipe->total_grasa_total / $detail->recipe->portions) * $detail->portions),3,',','.') }}
                                    </strong>
                                </td>
                            </tr>
                        @endif
                    </tfoot>
                @endif
            </table>
        </div>
    @endforeach
</div>

