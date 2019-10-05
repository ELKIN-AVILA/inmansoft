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
                minlength:1,
                maxlength:45
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            $.ajax({
                type:'POST',
                url:'/Marcaequi/guardar',
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
                required:true,
                minlength:1,
                maxlength:45
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var nombre=$("#nombreedi").val();
            $.ajax({
                type:'POST',
                url:'/Marcaequi/actualizar',
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
        url:'/Marcaequi/editar',
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
            url:'/Marcaequi/eliminar',
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