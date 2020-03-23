<div class="row mt-4" style="margin-top: 0px !important;">
    <div class="col">
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="not-export-col">Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div><!--col-->
</div><!--row-->


@push('after-scripts')
    @include('datatables.includes')
    <script>
        $(function () {
            $('.data-table').DataTable({
                "processing": true,
                "serverSide": true,
                "draw": true,
                "buttons": [],
                ajax: "{{ route('admin.recipe.index') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false,},
                ]
            });
        });
    </script>
@endpush
