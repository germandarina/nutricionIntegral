@if($basic_information->textRecommendations->isNotEmpty() || $basic_information->imageRecommendations->isNotEmpty())
    <div>
        <h3 style="text-align: center; border-bottom: 3px solid {!! $color_days !!}; color: {!! $color_days !!}; padding: 3px; font-size: 30px !important;">RECOMENDACIONES</h3>

        @if($basic_information->textRecommendations->isNotEmpty())
            <div>
                <ul style="font-size: 20px;">
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
