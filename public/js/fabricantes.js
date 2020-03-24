function editarFabricante(obj){
    window.id=obj.getAttribute('data-id')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'infoFabricante/'+window.id,
        type:'get',
        dataType:'json',
        success:function(json){
            let fabricantes=document.querySelectorAll('#salvarFabricante > div > input')
            let count=0
            for(let [key,value] of Object.entries(json)){
                fabricantes[count].setAttribute('value',value)
                count++
            }
        }
    })
    $('#editarFabricante').modal('show')
}

function salvarFabricante(){
    $('#salvarFabricante').submit(function(e){
        e.preventDefault()
        var forms=$(this).serialize()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'salvarFabricante/'+window.id,
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
    $('#enviarFabricante').trigger('click')
}


function excluirFabricante(obj){
    window.id_cliente=obj.getAttribute('data-id')
    $('#excluirFabricante').modal('show')
}

function excluirFabricanteTrue(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'excluirFabricante/'+window.id_cliente,
        type:'delete',
        success:function(){
            window.location.href=window.location.href
        }
    })
}
