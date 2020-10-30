@if($basic_information->textRecommendations->isNotEmpty() || $basic_information->imagetRecommendations->isNotEmpty())
    <div >
        <h3 style="text-align: center; background-color: lightgrey; padding: 3px;">RECOMENDACIONES</h3>

        @if($basic_information->textRecommendations->isNotEmpty())
            <div>
                <ul style="font-size: 15px;">
                    @foreach($basic_information->textRecommendations as $recommendation)
                        <li><strong>{{ $recommendation->recommendation }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($basic_information->imageRecommendations->isNotEmpty())
            @foreach($basic_information->imageRecommendations as $recommendation)
                <div id="logo_grande">
                    <img src="{{ public_path("img/backend/client/{$recommendation->recommendation}") }}" >
                </div>
                <div style="page-break-after: always;"></div>
            @endforeach
        @endif
    </div>
@endif
