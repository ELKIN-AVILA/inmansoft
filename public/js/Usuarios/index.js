$(document).ready(function(){
    $("#datos").dataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            nombre:{
                required:true,
            },
            correo:{
                required:true,
            },
            contrasena:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            var correo=$("#correo").val();
            var contrasena=$("#contrasena").val();
            $.ajax({
                type:'POST',
                url:'/Usuarios/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre,
                    'correo':correo,
                    'contrasena':contrasena
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
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var contrasena=$("#contrasenaedit").val();
            $.ajax({
                type:'POST',
                url:'/Usuarios/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre
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
        url:'/Usuarios/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                
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
            url:'/Tipequipo/eliminar',
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