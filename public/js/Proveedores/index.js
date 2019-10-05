$(document).ready(function(){
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            nit:{
                required:true
            },
            razonsoc:{
                required:true
            },
            direccion:{
                required:true
            },
            correo:{
                required:true
            }

        },
        submitHandler:function(){
            var nit=$("#nit").val();
            var razonsoc=$("#razonsoc").val();
            var direccion=$("#direccion").val();
            var correo=$("#correo").val();
            $.ajax({
                type:'POST',
                url:'/Proveedores/guardar',
                data:{
                    '_token':_token,
                    'nit':nit,
                    'razonsoc':razonsoc,
                    'direccion':direccion,
                    'correo':correo
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
            nitedi:{
                required:true
            },
            razonsocedi:{
                required:true
            },
            direccionedi:{
                required:true
            },
            correoedi:{
                required:true
            }

        },
        submitHandler:function(){
            var id=  $("#idedi").val();
            var nit= $("#nitedi").val();
            var razonsoc=$("#razonsocedi").val();
            var direccion= $("#direccionedi").val();
            var correo=$("#correoedi").val();
            $.ajax({
                type:'POST',
                url:'/Proveedores/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nit':nit,
                    'razonsoc':razonsoc,
                    'direccion':direccion,
                    'correo':correo
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
    $("#nuevo").modal('show');
}
function editar(id){

    $.ajax({
        type:'POST',
        url:'/Proveedores/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                console.log(element);
                $("#idedi").val(element.id);
                $("#nitedi").val(element.nit);
                $("#razonsocedi").val(element.razonsoc);
                $("#direccionedi").val(element.direccion);
                $("#correoedi").val(element.correo);
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
            url:'/Proveedores/eliminar',
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