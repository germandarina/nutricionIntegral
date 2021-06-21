@extends('backend.layouts.app')

@section('title', app_name() . ' | Calcular Equivalencias')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h5 class="card-title mb-0">
                    Calcular Equivalencias
                </h5>
            </div><!--col-->
        </div><!--row-->
        <hr>

        <div class="row mt-4">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                        {{ html()->label('Alimento')
                                       ->class('col-md-2 form-control-label')
                                       ->for('food_id') }}
                        <div class="col-md-12">
                            {{ html()->select('food_id',[])
                                ->class('form-control')
                                ->placeholder('Buscar alimento...')
                                ->attribute("id","food_id")
                                ->required()
                                }}
                        </div><!--col-->
                </div>
            </div><!--col-->
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    {{ html()->label('Gramos')
                                      ->class('col-md-3 form-control-label')
                                      ->for('grs') }}

                    <div class="col-md-10">
                        {{ html()->input('number','grs')
                        ->class('form-control')
                        ->placeholder('Grs')
                        ->required()
                        ->autofocus() }}
                    </div>
                </div>
            </div>
            <div class="col-sm-3  col-xs-12">
                <br class="d-none d-sm-inline-flex"><br class="d-none d-sm-inline-flex">
                <a href="#" class="btn btn-info btn-sm" onclick="getValuesForFood(event)"><i class="fas fa-clipboard-list"></i> Obtener Valores</a>
            </div>
        </div><!--row-->
        <div id="div_result_food">

        </div>
        <div id="div_equivalence" style="display: none;">
            <div class="row mt-4">
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        {{ html()->label('Alimento Equivalente')
                                       ->class('col-md-4 form-control-label')
                                       ->for('equivalence_id') }}
                        <div class="col-md-12">
                            {{ html()->select('equivalence_id',[])
                                ->class('form-control')
                                ->placeholder('Buscar alimentos equivalentes...')
                                ->attribute("id","equivalence_id")
                                ->required()
                                }}
                        </div><!--col-->
                    </div>
                </div><!--col-->
                <div class="col-sm-3 col-xs-12">
                    <div class="form-group">
                        {{ html()->label('Gramos')
                                          ->class('col-md-3 form-control-label')
                                          ->for('grs_equivalence') }}

                        <div class="col-md-10">
                            {{ html()->input('number','grs_equivalence')
                            ->class('form-control')
                            ->placeholder('Grs')
                            ->required()
                            ->autofocus() }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3  col-xs-12">
                    <br class="d-none d-sm-inline-flex">
                    <a href="#" class="btn btn-info btn-sm" onclick="getEquivalence(event)"><i class="fas fa-clipboard-list"></i> Obtener Equivalencia</a>
                </div>
            </div><!--row-->
        </div>
        <div id="div_equivalence_result">

        </div>
    </div><!--card-body-->
</div><!--card-->

@endsection

@push('after-scripts')
    <script>
        var procesando = null;
        $(function ()
        {
            $('#food_id').select2({
                placeholder: "Buscar alimentos...",
                minimumInputLength: 2,
                language: {
                    noResults: function () {
                        return "No hay resultados";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function(a){
                        return"Por favor ingrese "+(a.minimum-a.input.length)+" o más caracteres"
                    }
                },
                ajax: {
                    url: "{{ route('admin.recipe.searchIngredients') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $('#equivalence_id').select2({
                placeholder: "Buscar alimentos equivalentes...",
                minimumInputLength: 2,
                language: {
                    noResults: function () {
                        return "No hay resultados";
                    },
                    searching: function () {
                        return "Buscando...";
                    },
                    inputTooShort: function(a){
                        return"Por favor ingrese "+(a.minimum-a.input.length)+" o más caracteres"
                    }
                },
                ajax: {
                    url: "{{ route('admin.recipe.searchIngredients') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $("span.select2.select2-container.select2-container--default").css("width","100%");
        });

        function getValuesForFood(event)
        {
            event.preventDefault();
            var food_id  = $("#food_id").val();
            var quantity = $("#grs").val();

            if(food_id === null || food_id === 0 || food_id === '')
                return Lobibox.notify('error',{msg:'Ingrese un alimento'});

            if(quantity === null || quantity === 0 || quantity === '')
                return Lobibox.notify('error',{msg:'Ingrese la cantidad'});

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:   '{{ route('admin.recipe.calculateGrs') }}',
                type:  'POST',
                data:   {
                    'food_id': food_id,
                    'quantity': quantity
                },
                success: function(data) {
                    procesando.remove();
                    $('#div_result_food').empty().html(data);
                    $('#div_equivalence').show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }

        function getEquivalence(event)
        {
            event.preventDefault();
            var quantity = $('#grs_equivalence').val();
            var equivalence_id = $('#equivalence_id').val();

            if(equivalence_id === null || equivalence_id === 0 || equivalence_id === '')
                return Lobibox.notify('error',{msg:'Ingrese un alimento equivalente'});

            if(quantity === null || quantity === 0 || quantity === '')
                return Lobibox.notify('error',{msg:'Ingrese la cantidad equivalente'});

            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:   '{{ route('admin.equivalence.calculate') }}',
                type:  'POST',
                data:   {
                    // 'food_id': food_id,
                    'quantity': quantity,
                    'equivalence_id':equivalence_id
                },
                success: function(data) {
                    procesando.remove();
                    $('#div_equivalence_result').empty().html(data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }


    </script>
@endpush

