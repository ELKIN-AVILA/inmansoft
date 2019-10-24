$(document).ready(function(){
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            sede_id:{
                required:true
            },
            departamentos_id:{
                required:true
            },
            dependencias_id:{
                required:true
            },
            empleados_id:{
                required:true
            }
        },
        submitHandler:function(){
            var sede=$("#sede_id").val();
            var departamentos=$("#departamentos_id").val();
            var empleados=$("#empleados_id").val();
            var dependencias=$("#dependencias_id").val();
            $.ajax({
                type:'POST',
                url:'/Jefedependencia/guardar',
                data:{
                    '_token':_token,
                    'sede_id':sede,
                    'departamentos_id':departamentos,
                    'empleados_id':empleados,
                    'dependencias':dependencias
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
            sede_id:{
                required:true
            },
            departamentos_id:{
                required:true
            },
            dependencias_id:{
                required:true
            },
            empleados_id:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var sede=$("#sede_idedi").val();
            var departamentos=$("#departamentos_idedi").val();
            var empleados=$("#empleados_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Jefedepartamento/actualizar',
                data:{
                    '_token':_token,
                    'sede_id':sede,
                    'departamentos_id':departamentos,
                    'empleados_id':empleados
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
function depart(id){
    $("#departamentos_id").empty();
    var val=id.value;
    $.ajax({
        type:'POST',
        url:'/Jefedependencia/depart',
        data:{
            '_token':_token,
            'id':val
        },
        success:function(data){
                $("#departamentos_id").append("<option value=''>----Seleccione---</option>");
            data.forEach(element => {
                $("#departamentos_id").append("<option value="+element.id+">"+element.nombre+"</option>")
            });
        }
    });
}

function dependencias(id){
    $("#dependencias_id").empty();
    var val=id.value;
    $.ajax({
        type:'POST',
        url:'/Jefedependencia/dependencias',
        data:{
            '_token':_token,
            'id':val
        },
        success:function(data){
                $("#dependencias_id").append("<option value=''>----Seleccione---</option>");
            data.forEach(element => {
                $("#dependencias_id").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    });
}

function dependenciasedi(id){
    $("#dependencias_idedi").empty();
    var val=id.value;
    $.ajax({
        type:'POST',
        url:'/Jefedependencia/dependencias',
        data:{
            '_token':_token,
            'id':val
        },
        success:function(data){
            data.forEach(element => {
                $("#dependencias_idedi").append("<option value="+element.id+">"+element.nombre+"</option>")
            });
        }
    });
}
function departa(id){
    $("#departamentos_idedi").empty();
    var val=id.value;
    $.ajax({
        type:'POST',
        url:'/Jefedependencia/depart',
        data:{
            '_token':_token,
            'id':val
        },
        success:function(data){
            data.forEach(element => {
                $("#departamentos_idedi").append("<option value="+element.id+">"+element.nombre+"</option>")
            });
        }
    });
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Jefedependencia/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element=>{
                $("#idedi").val(element.id);
                $("#sede_idedi").val(element.sede_id);
                $("#departamentos_idedi").val(element.departamentos_id);
                $("#dependencias_idedi").val(element.dependencias_id);
                $("#empleados_idedi").val(element.empleados_id);
            });
            $("#editar").modal("show");
        }
    })
}
function eliminar(id){
    alertify.confirm("Esta seguro de eliminar el Registro",
    function(){
        $.ajax({
            type:'POST',
            url:'/Jefedependencia/eliminar',
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
