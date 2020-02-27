function addVenda(){
    $('#form_addvenda').submit(function(e){
        e.preventDefault()
        
        var forms=$(this).serialize()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'addVendas',
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
    $('#click_addvenda').trigger('click')
}