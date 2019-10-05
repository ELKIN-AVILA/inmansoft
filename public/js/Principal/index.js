$(document).ready(function(){
    $("#formcompo").hide();
    $("#formulario").validate({
        rules:{
            sede_id:{
                required:true,
            },
            departamentos_id:{
                required:true
            },
            dependencias_id:{
                required:true
            }
        },
        submitHandler:function(){
            var sede=$("#sede_id").val();
            var departamentos=$("#departamentos_id").val();
            var dependencias_id=$("#dependencias_id").val();
            $.ajax({
                type:'POST',
                url:'/Home/equipos',
                data:{
                    '_token':_token,
                    'sede_id':sede,
                    'departamentos':departamentos,
                    'dependencias':dependencias_id
                },
                success:function(data){
                        $("#contenido").empty();
                        var html="";
                        data['equipos'].forEach(element=>{
                            html+="<div class='col-sm-4'>";
                            html+="<div class='panel panel-primary'>";
                            html+="<div class='panel-heading'>Numero de placa "+element['0']['numplaca']+"</div>";
                            html+="<div class='panel-body'>";
                            html+="<button class='btn btn-success' onclick='programas("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Programas'><i class='fa fa-laptop' style='font-size:-webkit-xxx-large'></i></button>";
                            html+="<button class='btn btn-warning' onclick='hardware("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hardware'><i class='fa fa-microchip' style='font-size:-webkit-xxx-large'></i></button>";
                            html+="<button class='btn btn-info' onclick='hoja("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hoja de vida'><i class='fa fa-folder-open-o' style='font-size:-webkit-xxx-large'></i></button>";
                            html+="<button onclick='mantenimientos("+element['0']['id']+");' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Mantenimiento'><i class='fa fa-cog' style='font-size:-webkit-xxx-large'></i></button>"
                            html+="</div>";   
                            html+="</div>";
                            html+="</div>";
                        });
                        $("#contenido").append(html);
                } 
            });
        }
    });    
   $("#formulpro").validate({
  	rules:{
		progr_id:{
			required:true
		},
	    versionpro_id:{
            required:true
        },
        licencia:{
            required:true
        },
        fechainst:{
            required:true
        },
        fechacadu:{
            required:true
        }	
    },
    submitHandler:function(){
        var idequipo=$("#ideqpro").val();
        var progr_id=$("#progr_id").val();
        var versionpro_id=$("#version_proid").val();
        var licencia=$("#licencia").val();
        var fechainst=$("#fechainst").val();
        var fechacadu=$("#fechacadu").val();

        $.ajax({
            type:'POST',
            url:'/Home/guardarprogequi',
            data:{
                '_token':_token,
                'idequipo':idequipo,
                'prog_id':progr_id,
                'version':versionpro_id,
                'licencia':licencia,
                'fechainst':fechainst,
                'fechacadu':fechacadu
            },
            success:function(data){
                alertify.success(data.msg);
                $("#progr_id").val(" ");
                $("#version_proid").val(" ");
                $("#licencia").val(" ");
                $("#fechainst").val(" ");
                $("#fechacadu").val(" ");
                actupro(data.idequipo);   
            }
        });
    }
   });
});
/**Componentes */
function hardware(id){
    $.ajax({
        type:'POST',
        url:'/Home/componentes',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            if(data.length!=0){
            }
            $("#componentes").modal("show");
        }
    });
}
function nuevocomponen(){
    $("#formcompo").show();
}
function traecomponente(id){
    var idv=id.value;
    $.ajax({    
        type:'POST',
        url:'/Home/traecomponente',
        data:{
            '_token':_token,
            'id':idv
        },
        success:function(data){
            $("#componenteid").append("<option>---Selecione---</option>");
            data.forEach(element=>{
                $("#componenteid").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    })
}
/** */

function mantenimientos(id){
    $("#manteni > tbody").empty();
    $.ajax({
        type:'POST',
        url:'/Home/mantenimientos',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            var i=0;
            data.forEach(element=>{
                i++;
                tipo="";
                if(element.tipo=="P"){
                    tipo="Programada";
                }else{
                    tipo="No Programada";
                }
                $("#manteni > tbody:last-child").append("<tr><td>"+i+"</td><td>"+element.fecha+"</td><td>"+tipo+"</td><td></td><td><button>Mantenimiento</button></td></tr>")
            });
            $("#mantenimientos").modal("show");
        }
    });
}
function nuevoman(){
    $("#nuevoman").modal("show");
}
/**actualizar la url del disparador */
function departamentos(id){
    $("#departamentos_id").empty();
    $.ajax({
        type:'POST',
        url:'/Home/traedepar',
        data:{
            '_token':_token,
            'id':id.value
        },
        success:function(data){
        $("#departamentos_id").append("<option>---Selecione---</option>")
         data['departamentos'].forEach(element => {
              $("#departamentos_id").append("<option value="+element.id+">"+element.nombre+"</option>");
         });    
               
        }
    });

}
function dependencias(id){
    $("#dependencias_id").empty();
    $.ajax({
        type:'POST',
        url:'/Home/traerdependencias',
        data:{
            '_token':_token,
            'id':id.value
        },
        success:function(data){
          
            $("#dependencias_id").append("<option>---Selecione---</option>")

            data['dependencias'].forEach(element => {
                $("#dependencias_id").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    });
}
function equipos(id){
    $.ajax({
        type:'POST',
        url:'/Home/traerequipos',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            $("#equipos").empty();
            var html="";
            
            data['equipos'].forEach(element=>{
                    html+="<div class='col-sm-4'>";
                    html+="<div class='panel panel-primary'>";
                    html+="<div class='panel-heading'>Numero placa:"+element['0']['numplaca']+"</div>";
                    html+="<div class='panel-body'>";
                    html+="<button class='btn btn-primary btn-sm'>Mantenimientos</button>"; 
                    html+="</div>";
                    html+="</div>";
                    html+="</div>";
        });
            $("#equipos").append(html);
        }
    });
}
function programas(id){
    $("#prolist tr:not(:first-child)").remove();
    $.ajax({
        type:'POST',
        url:'/Home/traeprogramas',
        data:{
            '_token':_token,
            'id':id
            
        },
        success:function(data){
            console.log(data);
            var band=0;
            data['softxequi'].forEach(element=>{
                    var nombre="";
                    data['version'].forEach(ell=>{ 
                                if(ell.id==element.versionpro_id){
                                    nombre=ell.nombre;
                                }
                    }); 
                        $('#prolist tr:last').after("<tr><td style='text-align:left;'>"+data['programas'][band]['nombre']+"</td><td style='text-align:left;'>"+nombre+"</td><td>"+element.estado+"</td><td><button class='btn btn-warning' onclick='editarpro("+element.id+")'><i class='fa fa-edit'></i></button><button class='btn btn-danger' onclick='eliminarpro("+element.id+")'><i class='fa fa-trash'></i></button></td></tr>");
                        band+=1;
            });               
            data['equipo'].forEach(element=>{
                $("#ideqpro").val(element.id);
                $("#numplpro").val(element.numplaca);
            });
            $("#progr_id").empty();

            $("#progr_id").append("<option>----Selecione----</option>");
            data['programas'].forEach(element=>{
                $("#progr_id").append("<option value="+element.id+">"+element.nombre+"</option>");
            }); 
            $("#nuevopro").modal('show');
        }
    });

}
function editarpro(id){
    $.ajax({
        type:'POST',
        url:'/Home/editarpro',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            $("#progr_idedi").val(data.programa_id);
            data['software'].forEach(element=>{
                $("#licenciaedi").val(element.licencia);
                $("#fechainstedi").val(element.fechainst);
                $("#fechacaduedi").val(element.fechacaducid);
            });
            $("#editprog").modal("show");
        }
    });
}
function actupro(id){
/** */
$("#prolist tr:not(:first-child)").remove();
$.ajax({
    type:'POST',
    url:'/Home/traeprogramas',
    data:{
        '_token':_token,
        'id':id
        
    },
    success:function(data){
        console.log(data);
        var band=0;
        data['softxequi'].forEach(element=>{
                var nombre="";
                data['version'].forEach(ell=>{ 
                            if(ell.id==element.versionpro_id){
                                nombre=ell.nombre;
                            }
                }); 
                    $('#prolist tr:last').after("<tr><td style='text-align:left;'>"+data['programas'][band]['nombre']+"</td><td style='text-align:left;'>"+nombre+"</td><td>"+element.estado+"</td><td><button class='btn btn-danger' onclick='eliminarpro("+element.id+")'><i class='fa fa-trash'></i></button></td></tr>");
                    band+=1;
        });               
        data['equipo'].forEach(element=>{
            $("#ideqpro").val(element.id);
            $("#numplpro").val(element.numplaca);
        });
        $("#progr_id").empty();

        $("#progr_id").append("<option>----Selecione----</option>");
        data['programas'].forEach(element=>{
            $("#progr_id").append("<option value="+element.id+">"+element.nombre+"</option>");
        }); 
        
    }
});


/**/
}
function eliminarpro(id){
    alertify.confirm("Esta seguro de eliminar el Registro",
    function(){
        $.ajax({
            type:'POST',
            url:'/Home/eliminarpro',
            data:{
                '_token':_token,
                'id':id
            },
            success:function(data){
                alertify.success(data['msg']);
                actupro(data['idequipo']);
            }
        });
    });
}
function traepro(id){
    $("#prolist tr:not(:first-child)").remove();
    $.ajax({
        type:'POST',
        url:'/Home/traeprogramas',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            var band=0;
            data['softxequi'].forEach(element=>{
                    var nombre="";
                    data['version'].forEach(ell=>{
                                if(ell.id==element.versionpro_id){
                                    nombre=ell.nombre;
                                }
                    }); 
                        $('#prolist tr:last').after("<tr><td style='text-align:left;'>"+data['programas'][band]['nombre']+"</td><td style='text-align:left;'>"+nombre+"</td><td>"+element.estado+"</td></tr>");
                        band+=1;
            });               
            data['equipo'].forEach(element=>{
                $("#ideqpro").val(element.id);
                $("#numplpro").val(element.numplaca);
            });
            $("#progr_id").append("<option>----Selecione----</option>");
            data['programas'].forEach(element=>{
                $("#progr_id").append("<option value="+element.id+">"+element.nombre+"</option>");
            }); 
            $("#nuevopro").modal('show');
        }
    });

}
function versionpro(id){
    $("#version_proid").empty();
    var idv=id.value;
    $.ajax({
        type:'POST',
        url:'/Home/traeversiones',
        data:{
            '_token':_token,
            'id':idv
        },
        success:function(data){   
            $("#version_proid").append("<option>----Selecione----</option>");
            data.forEach(element=>{
                $("#version_proid").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    }); 
}

function versionproid(id){
    $("#version_proidedi").empty();
    var idv=id.value;
    $.ajax({
        type:'POST',
        url:'/Home/traeversiones',
        data:{
            '_token':_token,
            'id':idv
        },
        success:function(data){   
            $("#version_proidedi").append("<option>----Selecione----</option>");
            data.forEach(element=>{
                $("#version_proidedi").append("<option value="+element.id+">"+element.nombre+"</option>");
            });
        }
    }); 
}