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
            equipos_id:{
                required:true
            }
        },
        submitHandler:function(){
            var sede=$("#sede_id").val();
            var departamento=$("#departamentos_id").val();
            var dependencias=$("#dependencias_id").val();
            var equipos=$("#equipos_id").val();
            $.ajax({
                type:'POST',
                url:'/Localizacion/guardar',
                data:{
                    '_token':_token,
                    'sede':sede,
                    'departamento':departamento,
                    'dependencias':dependencias,
                    'equipos':equipos
                },
                success:function(data){
                    alertify.success(data);
                    location.reload();
                }
            });
        }
    });
    /**val edit */
    $("#formularioedi").validate({
        rules:{
            sede_idedi:{
                required:true
            },
            departamentos_idedi:{
                required:true
            },
            dependencias_idedi:{
                required:true
            },
            equipos_idedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var sede=$("#sede_idedi").val();
            var departamento=$("#departamentos_idedi").val();
            var dependencias=$("#dependencias_idedi").val();
            var equipos=$("#equipos_idedi").val();
            $.ajax({
                type:'POST',
                url:'/Localizacion/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'sede':sede,
                    'departamento':departamento,
                    'dependencias':dependencias,
                    'equipos':equipos
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
function depend(val){
    $("#dependencias_id").empty();
    var id=val.value;
    $.ajax({
        type:'POST',
        url:'/Localizacion/traedepen',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#dependencias_id").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    });
}
function dependi(val){
    $("#dependencias_idedi").empty();
    var id=val.value;
    $.ajax({
        type:'POST',
        url:'/Localizacion/traedepen',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#dependencias_idedi").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    });
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Localizacion/editar',
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
                $("#equipos_idedi").val(element.equipos_id);
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
            url:'/Localizacion/eliminar',
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
function traedepar(id){
    $("#departamentos_id").empty();
    var idv=id.value;
    $.ajax({
        type:'POST',
        url:'/Dependencias/traedepar',
        data:{
            '_token':_token,
            'id':idv
        },
        success:function(data){
            $("#departamentos_id").append("<option>---Selecione---</option>");
            data.forEach(el=>{
                $("#departamentos_id").append("<option value="+el.id+">"+el.nombre+"</option>");
            });
        }
    });
}