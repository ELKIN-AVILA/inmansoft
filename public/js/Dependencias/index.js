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
            },
            departamentos_id:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            var departamento=$("#departamentos_id").val();
            $.ajax({
                type:'POST',
                url:'/Dependencias/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre,
                    'departamento':departamento
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
            },
            departamentosedi:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idedi").val();
            var nombre=$("#nombreedi").val();
            var departamentos=$("#departamentosedi").val();
            $.ajax({
                type:'POST',
                url:'/Dependencias/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre,
                    'departamentos':departamentos
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
        url:'/Dependencias/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#nombreedi").val(element.nombre);
                $("#departamentosedi").val(element.departamentos_id);
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
            url:'/Dependencias/eliminar',
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