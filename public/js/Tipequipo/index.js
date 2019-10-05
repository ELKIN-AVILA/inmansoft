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
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            $.ajax({
                type:'POST',
                url:'/Tipequipo/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre
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
            var nombre=$("#nombreedi").val();
            $.ajax({
                type:'POST',
                url:'/Tipequipo/actualizar',
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
        url:'/Tipequipo/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#nombreedi").val(element.nombre);
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