$(document).ready(function(){
    $("#informacion").modal('hide');
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            prinom:{
                required:true
            },
            priape:{
                required:true
            },
            cargo_id:{
                required:true
            },
            correo:{
                required:true
            },
            celular:{
                required:true
            }
        },
        submitHandler:function(){
            var priape=$("#priape").val();
            var segape=$("#segape").val();
            var prinom=$("#prinom").val();
            var segnom=$("#segnom").val();
            var correo=$("#correo").val();
            var celular=$("#celular").val();
            var cargo=$("#cargo_id").val();
            $.ajax({
                type:'POST',
                url:'/Empleados/guardar',
                data:{
                    '_token':_token,
                    'priape':priape,
                    'segape':segape,
                    'prinom':prinom,
                    'segnom':segnom,
                    'correo':correo,
                    'celular':celular,
                    'cargo':cargo
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
            priapeedi:{
                required:true
            },
            prinomedi:{
                required:true
            },
            cargo_idedi:{
                required:true
            },
            correoedi:{
                required:true
            },
            celularedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var priape=$("#priapeedi").val();
            var segape=$("#segapeedi").val();
            var prinom=$("#prinomedi").val();
            var segnom=$("#segnomedi").val();
            var correo=$("#correoedi").val();
            var celular=$("#celularedi").val();
            var cargo=$("#cargo_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Empleados/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'priape':priape,
                    'segape':segape,
                    'prinom':prinom,
                    'segnom':segnom,
                    'correo':correo,
                    'celular':celular,
                    'cargo':cargo
                },
                success:function(data){
                    alertify.success(data);

                    location.reload();
                }
            })
        }
    })

});

function nuevo(){
    $("#nuevo").modal('show');
}

function editar(id){
    $.ajax({
        type:'POST',
        url:'/Empleados/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#priapeedi").val(element.priape);
                $("#segapeedi").val(element.segape);
                $("#prinomedi").val(element.prinom);
                $("#segnomedi").val(element.segnom);
                $("#correoedi").val(element.correo);
                $("#celularedi").val(element.celular);
                $("#cargo_idedi").val(element.cargo_id);
            });
            $("#editar").modal("show");
        }
    })
}
function actualizar(){
    
}
function eliminar(id){
    alertify.confirm("Esta seguro de eliminar el Registro",
    function(){
        $.ajax({
            type:'POST',
            url:'/Empleados/eliminar',
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
