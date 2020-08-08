<h3 style="text-align: center;">DÍA {{ $i }}</h3>
<hr>
@foreach($details_days as $j => $detail)
    <div>
        @switch(true)
            @case($j == 0 and $detail->planDetail->recipe->recipe_type_id == 1)
                <h5>DESAYUNO</h5>
            @break

            @case(($j == 3 || $j == 4) and $detail->planDetail->recipe->recipe_type_id == 1)
                <h5>MERIENDA</h5>
            @break

            @case(($j == 1 || $j == 3) and $detail->planDetail->recipe->recipe_type_id == 3)
                <h5>COLACIÓN</h5>
            @break

            @case(($j == 1 || $j == 2) and $detail->planDetail->recipe->recipe_type_id == 2)
                <h5>ALMUERZO</h5>
            @break

            @case(($j == 4 || $j == 5) and $detail->planDetail->recipe->recipe_type_id == 2)
                <h5>CENA</h5>
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
        </table>
    </div>

@endforeach
{{--        <table>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th class="service">SERVICE</th>--}}
{{--            <th class="desc">DESCRIPTION</th>--}}
{{--            <th>PRICE</th>--}}
{{--            <th>QTY</th>--}}
{{--            <th>TOTAL</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td class="service">Design</td>--}}
{{--            <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>--}}
{{--            <td class="unit">$40.00</td>--}}
{{--            <td class="qty">26</td>--}}
{{--            <td class="total">$1,040.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td class="service">Development</td>--}}
{{--            <td class="desc">Developing a Content Management System-based Website</td>--}}
{{--            <td class="unit">$40.00</td>--}}
{{--            <td class="qty">80</td>--}}
{{--            <td class="total">$3,200.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td class="service">SEO</td>--}}
{{--            <td class="desc">Optimize the site for search engines (SEO)</td>--}}
{{--            <td class="unit">$40.00</td>--}}
{{--            <td class="qty">20</td>--}}
{{--            <td class="total">$800.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td class="service">Training</td>--}}
{{--            <td class="desc">Initial training sessions for staff responsible for uploading web content</td>--}}
{{--            <td class="unit">$40.00</td>--}}
{{--            <td class="qty">4</td>--}}
{{--            <td class="total">$160.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="4">SUBTOTAL</td>--}}
{{--            <td class="total">$5,200.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="4">TAX 25%</td>--}}
{{--            <td class="total">$1,300.00</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="4" class="grand total">GRAND TOTAL</td>--}}
{{--            <td class="grand total">$6,500.00</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
