$(document).ready(function(){
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            nombre:{
                required:true,
            },
            marcaequi_id:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            var marcaequi=$("#marcaequi_id").val();
            $.ajax({
                type:'POST',
                url:'/Modelequi/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre,
                    'marcaequi':marcaequi
                },
                success:function(data){
                    alertify.success(data);
                    location.reload();
                } 
            });
            
        }
    });
    $("#formularioedi").validate({
        rules:{
            nombreedi:{
                required:true
            },
            marcaequi_idedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var nombre=$("#nombreedi").val();
            var marcaequi=$("#marcaequi_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Modelequi/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre,
                    'marcaequi':marcaequi
                },
                success:function(data){
                    alertify.success(data);
                    location.reload();
                }
            });
        }
    })
});
function nuevo(){
    $("#nuevo").modal('show');
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Modelequi/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                    $("#idedi").val(element.id);
                    $("#nombreedi").val(element.nombre);
                    $("#marcaequi_idedi").val(element.marcaequi_id);
            });
            $("#editar").modal('show');
        }
    });
}
function eliminar(id){
    alertify.confirm("Esta seguro de eliminar el Registro",
    function(){
        $.ajax({
            type:'POST',
            url:'/Modelequi/eliminar',
            data:{
                '_token':_token,
                'id':id
            },
            success:function(data){
                alertify.success(data);
                location.reload();
            }
        });
    });
}