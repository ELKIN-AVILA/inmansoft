$(document).ready(function(){
    
    $("#formulario").validate({
        rules:{
            nombre:{
                required:true
            },
            estadoid:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            var estado=$("#estadoid").val();
            $.ajax({
                type:'POST',
                url:'/Sedes/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre,
                    'estado':estado
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
            estadoidedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var nombre=$("#nombreidedi").val();
            var estado=$("#estadoidedi").val();
            $.ajax({
                type:'POST',
                url:'/Sedes/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre,
                    'estado':estado
                },
                success:function(data){
                    alertify.success(data);
                    location.reload();
                }
            });
        }
    });
});
function nuevo(){
    $("#nuevo").modal("show");
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Sedes/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                    $("#idedi").val(element.id);
                    $("#nombreedi").val(element.nombre);
                    $("#estadoidedi").val(element.estado);
            });
            $("#editar").modal("show");
        }
    });
}
function eliminar(id){
    alertify.confirm("Esta seguro de eliminar el Registro",
    function(){
        $.ajax({
            type:'POST',
            url:'/Responsables/eliminar',
            data:{
                '_token':_token,
                'id':id
            },
            success:function(data){
                alertify.success(data);
                location.reload();
            }
        })
    });
}