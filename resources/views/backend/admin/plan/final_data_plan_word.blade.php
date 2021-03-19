<br><br><br><br><br><br>
@if($basic_information->textRecommendations->isNotEmpty() || $basic_information->imageRecommendations->isNotEmpty())
    <div>
        <h3 style="text-align: center; background-color: {!! $color_days !!}; padding: 3px;">RECOMENDACIONES</h3>

        @if($basic_information->textRecommendations->isNotEmpty())
            <div>
                <ul style="font-size: 20px;">
                    @foreach($basic_information->textRecommendations as $recommendation)
                        <li><strong>{{ $recommendation->recommendation }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif
