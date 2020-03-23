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
            let clientes=document.querySelectorAll('#salvarFabricante > div > input')
            clientes[0].setAttribute('value',json.nome)
            clientes[1].setAttribute('value',json.email)
            clientes[2].setAttribute('value',json.cnpj)
            clientes[3].setAttribute('value',json.estado)
            clientes[4].setAttribute('value',json.municipio)
            clientes[5].setAttribute('value',json.telefone)
            clientes[6].setAttribute('value',json.bairro)
            clientes[7].setAttribute('value',json.rua)
            clientes[8].setAttribute('value',json.numero)
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
