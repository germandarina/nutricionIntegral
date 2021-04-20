
{{ style('datatables/dataTables.bootstrap4.min.css') }}
{{--{{ script("datatables/pdfmake.min.js") }}--}}
{{ script("datatables/vfs_fonts.js") }}
{{--{{ script("datatables/popper.min.js") }}--}}
{{ script("datatables/datatables.js") }}
{{--{{ script("datatables/tooltip.min.js") }}--}}
{{ script("datatables/dataTables.buttons.min.js") }}
{{--{{ script("datatables/jszip.min.js") }}--}}
{{--{{ script("datatables/buttons.html5.min.js") }}--}}
{{--{{ script("datatables/buttons.print.min.js") }}--}}

<script>

    $.extend(true, $.fn.dataTable.defaults, {
        // dom: 'lftrip',
        // dom: '<"wrapper"flipt>',
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        // buttons: [
        //     {
        //         extend: 'pdfHtml5',
        //         exportOptions: {
        //             columns: ':visible:not(.not-export-col)'
        //         }
        //     },
        //     {
        //         extend: 'excelHtml5',
        //         exportOptions: {
        //             columns: ':visible:not(.not-export-col)'
        //         }
        //     },
        // ],
        responsive: true,
        paging:true,
        lengthChange : true,
        pageLength: 20,
        lengthMenu:[[20,50,100, -1], [20,50,100,"Todos"]],
        stateSave: true,
        fixedHeader: true,
        ordering: false,
        language: {
            "url": " {{ asset('/datatables/Spanish.json') }}"
        }
    });
</script>
