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
                minlength: 4,
                maxlength: 45
            },
            sede_id:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            var sede=$("#sede_id").val();
            $.ajax({
                type:'POST',
                url:'/Departamentos/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre,
                    'sede':sede
                },
                success:function(data){
                    alertify.success(data);
                    location.reload();
                }
            });       
        }
    });
    $("#formularioedi").validate({
        rule:{
            nombreedi:{
                required:true,
                minlength:4,
                maxlength:45
            },
            sede_idedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var nombre=$("#nombreedi").val();
            var sede=$("#sede_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Departamentos/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre,
                    'sede':sede
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
        url:'/Departamentos/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#nombreedi").val(element.nombre);
                $("#sede_idedi").val(element.sede_id);
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
            url:'/Departamentos/eliminar',
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