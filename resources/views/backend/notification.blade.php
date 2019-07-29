<script>

    @if(Session::has('success'))
        Lobibox.notify("success",{msg:"{{ Session::get('success') }}",'position': 'top right','title':'Exito'});
    //toastr.success();
    @endif

    @if(Session::has('info'))
        Lobibox.notify("info",{msg:"{{ Session::get('info') }}",'position': 'top right','title':'Informacion'});

    {{--toastr.info("{{ Session::get('info') }}");--}}
    @endif

    @if(Session::has('warning'))
        Lobibox.notify("warning",{msg:"{{ Session::get('warning') }}",'position': 'top right','title':'Advertencia'});
    {{--toastr.warning("{{ Session::get('warning') }}");--}}
    @endif

    @if(Session::has('error'))
        Lobibox.notify("error",{msg:"{{ Session::get('error') }}",'position': 'top right','title':'Error'});
    {{--toastr.error("{{ Session::get('error') }}");--}}
    @endif

</script>