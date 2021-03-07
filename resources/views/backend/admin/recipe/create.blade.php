@extends('backend.layouts.app')

@section('title', app_name() . ' | Crear Receta')

@section('content')
{{ html()->form('POST', route('admin.recipe.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h5 class="card-title mb-0">
                        <small class="text-muted">Crear Receta</small>
                    </h5>
                </div><!--col-->
            </div><!--row-->
            <hr>
            @include('backend.admin.recipe.partials.form')
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.recipe.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
@section('modal-yield')
    <div class="modal fade" id="modalObservation" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Observación</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="bodyIngredients">
                    <div class="row mt-3">
                        <div class="col-sm-2">
                            <label for="">Nombre</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name_observation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="btnObservation" class="btn btn-primary" type="button" onclick="storeObservation(event)">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after-scripts')
    {!! $validator !!}

    <script>

        function modalObservation(event)
        {
            event.preventDefault();
            $("#modalObservation").modal('show');
        }

        function storeObservation(event)
        {
            event.preventDefault();
            var observation = $("#name_observation").val();
            if(observation.trim() === ""){
                return Lobibox.notify('error',{msg: 'Ingrese el nombre'});
            }
            procesando = Lobibox.notify("warning",{msg:"Espere por favor...",'position': 'top right','title':'Procesando', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:   '{{ route('admin.recipe.storeObservation') }}',
                type:  'POST',
                data:   {
                    'observation': observation,
                },
                success: function(data) {
                    procesando.remove();
                    $("#name_observation").val("");
                    Lobibox.notify('success',{msg:data.mensaje});
                    var new_observation = new Option(data.observation.name, data.observation.id, false, false);
                    $('#observations').append(new_observation).trigger('change');
                    var observations = $('#observations').val();
                    observations.push(data.observation.id);
                    $("#observations").val(observations).trigger('change');
                },
                error: function(xhr, textStatus, errorThrown) {
                    procesando.remove();
                    Lobibox.notify('error',{msg: 'Error al intentar acceder a los datos'});
                }
            });
        }
    </script>
@endpush
