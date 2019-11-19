$(document).ready(function(){
    var fechaini;
    var fechafin;
    $('#date_range').daterangepicker({

    });
    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
        fechaini=picker.startDate.format('YYYY-MM-DD');
        fechafin=picker.endDate.format('YYYY-MM-DD');
      });
    $("#formularioag").validate({
        rules:{
            mantenimiento:{
                required:true
            },
            sede_id:{
                required:true
            },
            departamentos_id:{
                required:true
            },
            jefedepar:{
                required:true
            },
            dependencias_id:{
                required:true
            },
            date_range:{
                required:true
            }
        },
        submitHandler:function(){
            var id=$("#idag").val();
            var sede=$("#sede_id").val();
            var departamentos=$("#departamentos_id").val();
            var idjefe=$("#idjefe").val();
            var dependencias=$("#dependencias_id").val();
            var fci=fechaini;
            var fcf=fechafin;
            /**val fecha */
            $.ajax({
                type:'POST',
                url:'/Cronomantenimiento/guardardet',
                data:{
                    '_token':_token,
                    'iddet':id,
                    'sede':sede,
                    'departamentos':departamentos,
                    'idjefe':idjefe,
                    'dependencias':dependencias,
                    'fci':fci,
                    'fcf':fcf
                },
                success:function(data){
                    alertify.success(data);
                    $("#sede_id").val(" ");
                    $("#departamentos_id").val(" ");
                    $("#idjefe").val(" ");
                    $("#jefedepar").val(" ");
                    $("#dependencias_id").val(" ");
                    agregar(id);
                }
            });
        
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
                url:'/Cronomantenimiento/guardar',
                data:{
                    '_token':_token,
                    'nombre':nombre
                },
                success:function(data){
                    $.notify(data,"success");
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
            var id=$("#idcronoedit").val();
            var nombre=$("#nombreedi").val();
            
            $.ajax({
                type:'POST',
                url:'/Cronomantenimiento/actualizar',
                data:{
                    '_token':_token,
                    'id':id,
                    'nombre':nombre
                },
                success:function(data){
                    alertify.success(data);
                    $("#editar").modal("hide"); 
                    location.reload();
                }
            });
        }
    })
});

function actualizar(){
            
}
function nuevo(){
    $("#nuevo").modal("show");
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(ele=>{
                $("#idcronoedit").val(ele.id);
                $("#nombreedi").val(ele.nombre);
            });
            $("#editar").modal("show");

        }
    });
}
function eliminar(id){
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/eliminar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            if(data.val=="false"){
                alertify.success("Se elimino el cronograma");
            }else{
                alertify.error("No Se puede eliminar el cronograma ya que tiene proceso asociados");
            }
        }
    })
}
function agregar(id){
    $("#tablecr").empty();
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/traernombre',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data['cronomantenimiento'].forEach(element=>{
                $("#mantenimiento").val(element.nombre);
            });
            for(i=0;i<data['nomsede'].length;i++){
                $("#tablecrono").append("<tr><td>"+data['nomsede'][i]+"</td><td>"+data['nomdepart'][i]+"</td><td>"+data['nomdepen'][i]+"</td><td>"+data['detcrono'][i].fechaini+"</td><td>"+data['detcrono'][i].fechafin+"</td></tr>");
            }
           
            $("#idag").val(id);
            $("#agregar").modal("show");
        }
        
    });
        
}
function depart(id){
    $("#departamentos_id").empty();
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/depart',
        data:{
            '_token':_token,
            'id':id.value
        },
        success:function(data){
            $("#departamentos_id").append("<option>---Selecione---</option>")
            data.forEach(element => {
                $("#departamentos_id").append("<option value="+element['id']+">"+element['nombre']+"</option>");
            });
        }
    });
}
function dependencias(id){
    $("#dependencias_id").empty();
    var val=id.value;
    var sede=$("#sede_id").val();
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/dependencias',
        data:{
            '_token':_token,
            'id':val,
            'sede':sede
        },
        success:function(data){
            data['dependencias'].forEach(element=>{
                $("#dependencias_id").append("<option value="+element['id']+">"+element['nombre']+"</option>");
            });
        }
    });
}
function traerjefe(id){
    $("#jefedepar").val(" ");
    var sede=$("#sede_id").val();
    var departamentos=$("#departamentos_id").val();
    var val=id.value;
    
    $.ajax({
        type:'POST',
        url:'/Cronomantenimiento/traerjefe',
        data:{
            '_token':_token,
            'id':val,
            'sede':sede,
            'departamentos':departamentos
        },
        success:function(data){
            $("#idjefe").val(data['idjefe']);
            data['jefe'].forEach(element=>{
                $("#jefedepar").val(element);
            })
        },
        error:function(data){
            alertify.error("No tiene jefe asociado la dependencia por favor asocielo y vuelva a intentarlo");
        }
    });
}

function reporte(id){
    $.ajax({
        type:'GET',
        url:'/Cronomantenimiento/reporte',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){

        }
    })
}
