@if($bi_recommendations_text->isNotEmpty() || $bi_recommendations_img->isNotEmpty() || $patient_recommendations_text->isNotEmpty() || $patient_recommendations_img->isNotEmpty())
    <div>
        <h3 style="text-align: center; border-bottom: 3px solid {!! $color_days !!}; color: {!! $color_days !!}; padding: 3px; font-size: 30px !important;">RECOMENDACIONES</h3>

        @if($patient_recommendations_text->isNotEmpty())
            <div>
                <ul style="font-size: 20px;">
                    @foreach($patient_recommendations_text as $recommendation)
                        <li><strong>{{ $recommendation->recommendation }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach($patient_recommendations_img as $recommendation)
            <div id="logo_grande">
                <img src="{{ public_path("img/backend/client/{$recommendation->recommendation}") }}" >
            </div>
            <div style="page-break-after: always;"></div>
        @endforeach


        @if($bi_recommendations_text->isNotEmpty())
            <div>
                <ul style="font-size: 20px;">
                    @foreach($bi_recommendations_text as $recommendation)
                        <li><strong>{{ $recommendation->recommendation }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach($bi_recommendations_img as $recommendation)
            <div id="logo_grande">
                <img src="{{ public_path("img/backend/client/{$recommendation->recommendation}") }}" >
            </div>
            <div style="page-break-after: always;"></div>
        @endforeach
    </div>
@endif
