window.onload=function(){
    var table_lines={
        lines:[],
        limit:4,

        maisTabulate:function(){
            this.limit+=4
            this.lines.slice(0,this.limit).forEach(function(item){
                item.removeAttribute('hidden')
            })
            
        },

        menosTabule:function(){
            this.limit-=4
            this.lines.slice(this.limit,-1).forEach(function(item){
                item.setAttribute('hidden','hidden')
            })
            
        }
        
    }
    document.querySelectorAll('tr[hidden]').forEach((item)=>{
        table_lines.lines.push(item)
    })
    table_lines.lines.slice(0,table_lines.limit).forEach((item)=>{
        item.removeAttribute('hidden')
    })
    document.getElementById('ver_mais').addEventListener('click',function(){
        table_lines.maisTabulate()
    })
    document.getElementById('ver_menos').addEventListener('click',function(){
        table_lines.menosTabule()
    })

    if(window.screen.width<=1024){
        var menu=document.getElementsByClassName('corpo')[0]
        menu.classList.remove('col-9')
        menu.classList.remove('corpo')
        menu.classList.add('col-12')
        menu.classList.add('corpo')
    }
}
