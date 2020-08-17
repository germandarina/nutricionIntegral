
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
    // $(function () {
    //     setTimeout(function () {
            // $(".dt-buttons").addClass("btn-sm");
            // $(".dt-buttons").children().addClass("btn-sm");
            // $(".dt-buttons").children().removeClass("btn-secondary").addClass("btn-dark");
            // $("#DataTables_Table_0_wrapper").children().css("font-size","0.75rem");
            // $("#DataTables_Table_0_wrapper>table").attr('data-form','deleteForm');
            // $("#DataTables_Table_0_wrapper>table").attr('data-toggle','dataTable');

            // $('.delete-item,.restore-item').on('click', '', function(e){
            //     e.preventDefault();
            //
            //     var url = "",
            //         msj = "Se eliminó correctamente";
            //
            //     $("#delete-btn").empty();
            //     if($(this).hasClass('delete-item')){
            //         $("#delete-btn").html("Eliminar");
            //     }else{
            //         $("#delete-btn").html("Restaurar");
            //         msj = "Se restauró correctamente";
            //     }
            //
            //     $('#confirm').removeClass('swal2-hide');
            //     $('#confirm').addClass('swal2-container swal2-center swal2-fade swal2-shown');
            //     url = $(this).attr('href');
            //     $('#confirm').modal({ backdrop: 'static', keyboard: false })
            //         .on('click', '#delete-btn', function(){
            //
            //             // confirm then
            //             $.ajax({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 },
            //                 url: url,
            //                 type: 'POST',
            //                 dataType: 'json',
            //                 data: {_method: 'POST'},
            //                 success: (function (data){
            //                     Lobibox.notify("success",{msg: data.mensaje,'position': 'top right','title':'Éxito'});
            //                 }),
            //                 error: (function (jqXHR, exception) {
            //                     var mensaje = "";
            //                     if (jqXHR.status === 422){
            //                         mensaje = jqXHR.responseJSON.mensaje
            //                         Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error'});
            //                     }
            //                 }),
            //                 complete:(function (data) {
            //                     $('#confirm').modal('hide');
            //                     $('.data-table').DataTable().draw(false);
            //                 })
            //             });
            //
            //         });
            // });
    //     },100);
    // });

    $.extend(true, $.fn.dataTable.defaults, {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
        ],
        responsive: true,
        paging:true,
        lengthChange : true,
        pageLength: 20,
        lengthMenu:[[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        stateSave: true,
        fixedHeader: true,
        language: {
            "url": "/datatables/Spanish.json"
        }
    });
</script>
