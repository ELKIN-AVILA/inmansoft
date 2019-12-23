$(document).ready(function(){
    $("#datos").DataTable({
        language:{
            url:'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        }
    });
    $("#formulario").validate({
        rules:{
            nombre:{
                required:true
            }
        },
        submitHandler:function(){
            var nombre=$("#nombre").val();
            $.ajax({
                type:'POST',
                url:'/Programas/guardar',
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
                url:'/Programas/actualizar',
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
    $("#formularioagr").validate({
        rules:{
            numver:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idag").val();
            var numver=$("#numver").val();
            $.ajax({
                type:'POST',
                url:'/Programas/guardarvers',
                data:{
                    '_token':_token,
                    'id':id,
                    'numver':numver
                },
                success:function(data){
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
        url:'/Programas/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(element => {
                $("#idedi").val(element.id);
                $("#nombreedi").val(element.nombre);
            });
            $("#editar").modal("show");
        }
    }); 
}
function eliminar(id){
    $.ajax({
        type:'POST',
        url:'/Programas/eliminar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            alertify.success(data);
            location.reload();
        }
    });
}
function agregar(id){
    $('#versiones tr:not(:first-child)').remove();
    $.ajax({
        type:'POST',
        url:'/Programas/agregar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            if(data['version'].lenght!=0){
                    var i=0;
                    data['version'].forEach(element=>{
                        i+=1;
                        $('#versiones tr:last').after("<tr><td>"+i+"</td><td>"+element.nombre+"</td><td><button class='btn btn-danger' onclick='eliver("+element.id+")'><i class='fa fa-trash'></i></button></td></tr>");
                });
            }
            $("#nombrepro").val(data['nombre']);
            $("#idag").val(data['id']); 
            $("#agregar").modal('show');
        }
    });
}
function eliver(id){
    $.ajax({
        type:'POST',
        url:'/Programas/eliminarver',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            alertify.success(data);
            location.reload();
        }
    });
}
