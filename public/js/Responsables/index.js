$(document).ready(function(){
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            empleados_id:{
                required:true
            },
            equipos_id:{
                required:true
            }
        },
        submitHandler:function(){
            var equipos=$("#equipos_id").val();
            var empleados=$("#empleados_id").val();  
            $.ajax({
                type:'POST',
                url:'/Responsables/guardar',
                data:{
                    '_token':_token,
                    'equipos_id':equipos,
                    'empleados_id':empleados
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
            equipos_idedi:{
                required:true
            },
            empleados_idedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var empleados=$("#empleados_idedi").val();
            var equipos=$("#equipos_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Responsables/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'empleados_id':empleados,
                    'equipos_id':equipos
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
        url:'/Responsables/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#empleados_idedi").val(element.empleados_id);
                $("#equipos_idedi").val(element.equipos_id);
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