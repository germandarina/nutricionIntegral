<h3 style="text-align: center; background-color: lightgrey; padding: 5px;">DÍA {{ $day }}</h3>
@foreach($details_by_day as $j => $detail)
    <div>
        <h3>{{ strtoupper(\App\Models\PlanDetail::$types[$detail->order_type]) }}</h3>
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
