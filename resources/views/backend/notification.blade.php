<script>

    @if(Session::has('success'))
        Lobibox.notify("success",{msg:"{{ Session::get('success') }}",'position': 'top right','title':'Exito', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
    @endif

    @if(Session::has('info'))
        Lobibox.notify("info",{msg: "{{ Session::get('info') }}",'position': 'top right','title':'Informacion', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
    @endif

    @if(Session::has('warning'))
        Lobibox.notify("warning",{msg:"{{ Session::get('warning') }}",'position': 'top right','title':'Advertencia', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
    @endif

    @if(Session::has('error'))
        Lobibox.notify("error",{msg: "{{ Session::get('error') }}",'position': 'top right','title':'Error', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
    @endif

    @if(Session::has('validator'))
        var errores = "{{ Session::get('validator') }}";
        var split_errores = errores.split(',');
        var mensaje = '<ul>';
        $.each(split_errores,function (i,v){
            mensaje = `${mensaje} <li>${v}</li>`
        });
        mensaje = `${mensaje} </ul>`

        Lobibox.notify("error",{msg: mensaje,'position': 'top right','title':'Error', 'sound': false, 'icon': false, 'iconSource': false,'size': 'mini', 'iconClass': false});
    @endif

</script>
