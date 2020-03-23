function addCompra(){
    $('#formCompra').submit(function(e){
        e.preventDefault()

        var forms=$(this).serialize()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'addCompras',
            type:'post',
            dataType:'json',
            data:forms,

            success:function(json){
                if(json.status==0){
                    window.location.href=window.location.href
                }else{
                    alert(json.error)
                }
            }
        })
    })
    $('#clickCompra').trigger('click')
}