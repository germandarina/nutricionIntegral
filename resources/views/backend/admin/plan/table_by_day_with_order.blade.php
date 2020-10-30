<div class="page">
    <h3 style="text-align: center; background-color: lightgrey; padding: 3px;">DÍA {{ $day }}</h3>
    @foreach($details_by_day as $j => $detail)
        <h3>{{ strtoupper(\App\Models\PlanDetail::$types[$detail->order_type]) }} - {{ strtoupper($detail->recipe->name) }}</h3>
        <div>
            <table>
                <thead>
                <tr>
                    <th>INGREDIENTES</th>
                    <th>CANTIDAD</th>
                </tr>
                </thead>
                <tbody>
                @foreach($detail->recipe->ingredients as $ingredient)
                    <tr>
                        <td style="text-align: left; padding: 1px; border-bottom: 1px solid black;">{{$ingredient->food->name}}</td>
                        <td style="text-align: left; padding: 1px; border-bottom: 1px solid black;">{{$ingredient->quantity_description}} ({{$ingredient->quantity_grs}} grs)</td>
                    </tr>
                @endforeach
                </tbody>
                @if($detail->recipe->observations->isNotEmpty())
                    <tfoot>
                    <tr>
                        <td style="text-align: left;background-color: #b7f55b; padding: 1px;" colspan="2"><strong>OBSERVACIONES: {{ implode('. ', $detail->recipe->observations->pluck('name')->toArray() ) }}</strong></td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    @endforeach
</div>

