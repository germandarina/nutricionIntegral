
{{ style('datatables/dataTables.bootstrap4.min.css') }}
{{ script("datatables/pdfmake.min.js") }}
{{ script("datatables/vfs_fonts.js") }}
{{ script("datatables/popper.min.js") }}
{{ script("datatables/datatables.js") }}
{{ script("datatables/tooltip.min.js") }}
{{ script("datatables/dataTables.buttons.min.js") }}
{{ script("datatables/jszip.min.js") }}
{{ script("datatables/buttons.html5.min.js") }}
{{ script("datatables/buttons.print.min.js") }}

<script>
    $(function () {
        setTimeout(function () {
            $(".dt-buttons").addClass("btn-sm");
            $(".dt-buttons").children().addClass("btn-sm");
            $(".dt-buttons").children().removeClass("btn-secondary").addClass("btn-dark");
            $("#DataTables_Table_0_wrapper").children().css("font-size","0.75rem");
            $("#DataTables_Table_0_wrapper>table").attr('data-form','deleteForm');
            $("#DataTables_Table_0_wrapper>table").attr('data-toggle','dataTable');

            $('table[data-form="deleteForm"]').on('click', '.delete-item', function(e){
                $('#confirm').removeClass('swal2-hide');
                $('#confirm').addClass('swal2-container swal2-center swal2-fade swal2-shown');

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var url = $(this).attr('href');
                $('#confirm').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){

                        // confirm then
                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            data: {_method: 'POST'}
                        }).always(function (data) {
                            $('#confirm').modal('hide');
                            $('.data-table').DataTable().draw(false);
                            Lobibox.notify("success",{msg:'Se eliminó correctamente','position': 'top right','title':'Éxito'});
                        });
                    });
            });
        },100);
    });

    $.extend(true, $.fn.dataTable.defaults, {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        'paging':true,
        'lengthChange' : true,
        'pageLength': 20,
        'lengthMenu':[[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        "stateSave": true,
        "language": {
            "url": "/datatables/Spanish.json"
        }
    });
</script>