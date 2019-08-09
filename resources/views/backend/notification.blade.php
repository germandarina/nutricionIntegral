<script>

    @if(Session::has('success'))
        Lobibox.notify("success",{msg:"{{ Session::get('success') }}",'position': 'top right','title':'Exito'});
    @endif

    @if(Session::has('info'))
        Lobibox.notify("info",{msg:"{{ Session::get('info') }}",'position': 'top right','title':'Informacion'});
    @endif

    @if(Session::has('warning'))
        Lobibox.notify("warning",{msg:"{{ Session::get('warning') }}",'position': 'top right','title':'Advertencia'});
    @endif

    @if(Session::has('error'))
        Lobibox.notify("error",{msg:"{{ Session::get('error') }}",'position': 'top right','title':'Error'});
    @endif

</script>