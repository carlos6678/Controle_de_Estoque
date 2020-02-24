function adicionarProduto(){
    $('#enviarProduto').submit(function(e){
        e.preventDefault()

        var formula=$(this).serialize()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'addProduto',
            data:formula,
            type:'post',
            dataType:'json',
            success:function(json){
                if(json.status==0){
                    window.location.href=window.location.href
                }if(json.status==1){
                    alert(json.error)
                }
            }
        })
    })
    $('#click').trigger('click')
}

function editarProduto(obj){
    window.produto_edit_id=obj.getAttribute('data-id')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'infoProduto/'+window.produto_edit_id,
        type:'get',
        dataType:'json',
        success:function(json){

            delete json.quantidade
            delete json.created_at
            delete json.updated_at
            console.log(json)
            $('#editProduto').modal('show')
            var inputs=document.querySelectorAll('#editarProduto > input')

            inputs[1].setAttribute('value',json.nome)
            inputs[2].setAttribute('value',json.fabricantes_id)
            inputs[3].setAttribute('value',json.representante)
            inputs[4].setAttribute('value',json.valor_venda)
            inputs[5].setAttribute('value',json.valor_compra)
            inputs[6].setAttribute('value',json.data_fabricaçao)
            inputs[7].setAttribute('value',json.data_vencimento)
        }
    })
}

function salvarProduto(){
    $('#editarProduto').submit(function(e){
        e.preventDefault()

        var forms=$(this).serialize()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'editProduto/'+window.produto_edit_id,
            type:'post',
            data:forms,
            dataType:'json',
            success:function(json){
                if(json.status==0){
                    window.location.href=window.location.href
                }
                if(json.status==1){
                    alert(json.error)
                    window.location.href=window.location.href
                }
            }
        })
    }) 
    $('#click2').trigger('click')
}

function excluirProduto(obj){
    $('#excluirProduto').modal('show')
    window.id_produto=obj.getAttribute('data-id')
}

function excluirProdutoReal(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'excluirProduto/',
        type:'delete',
        data:{
            "id":window.id_produto
        },
        success:function(){
            alert('Item apagado com sucesso')
            window.location.href=window.location.href
        }
    })
}