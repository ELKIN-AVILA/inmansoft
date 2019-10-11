$(document).ready(function(){
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
                            html+="<button class='btn btn-success' onclick='programas("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Software'><i class='fa fa-laptop' style='font-size: xx-large'></i></button>";
                            html+="<button class='btn btn-warning' onclick='hardware("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hardware'><i class='fa fa-wrench' style='font-size: xx-large'></i></button>";
                            html+="<button class='btn btn-info' onclick='hoja("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hoja de vida'><i class='fa fa-folder-open-o' style='font-size: xx-large'></i></button>";
                            html+="<button onclick='mantenimientos("+element['0']['id']+");' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Mantenimiento'><i class='fa fa-cog' style='font-size: xx-large'></i></button>"
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
   $("#formulproedi").validate({
    rules:{
		progr_idedi:{
			required:true
		},
	    versionpro_idedi:{
            required:true
        },
        licenciaedi:{
            required:true
        },
        fechainstedi:{
            required:true
        },
        fechacaduedi:{
            required:true
        }	
    },
    submitHandler:function(){
        var idequipo=$("#ideqproedi").val();
        var id=$("#idregqui").val();
        var progr_id=$("#progr_idedi").val();
        var versionpro_id=$("#version_proidedi").val();
        var licencia=$("#licenciaedi").val();
        var fechainst=$("#fechainstedi").val();
        var fechacadu=$("#fechacaduedi").val();

        $.ajax({
            type:'POST',
            url:'/Home/guardarprogequiactu',
            data:{
                '_token':_token,
                'id':id,
                'idequipo':idequipo,
                'prog_id':progr_id,
                'version':versionpro_id,
                'licencia':licencia,
                'fechainst':fechainst,
                'fechacadu':fechacadu
            },
            success:function(data){
                alertify.success(data.msg);
                $("#progr_idedi").val(" ");
                $("#version_proidedi").val(" ");
                $("#licenciaedi").val(" ");
                $("#fechainstedi").val(" ");
                $("#fechacaduedi").val(" ");
                $("#editprog").modal("hide");
                actupro(data.idequipo);   
            }
        });
    }
   });
   $("#formcomponentes").validate({
        rules:{
            'tipcomponent':{
                required:true
            },
            'componenteid':{
                required:true
            }
        },
        submitHandler:function(){
            var idequipo=$("#idequcompo").val();
            var tipcomponent=$("#tipcomponente").val();
            var componente=$("#componenteid").val();
            $.ajax({
                type:'POST',
                url:'/Home/guardarcomponente',
                data:{
                    '_token':_token,
                    'idequi':idequipo,
                    'componente':componente
                },
                success:function(data){
                    alertify.success(data.msg);
                    actucomponente(data.idequipo);
                }
            });
        }
   });
   $("#formulcompoedi").validate({
        rules:{
            tipcomponente_idcom:{
                required:true
            },
            componente_idedi:{
                required:true
            }
        },
        submitHandler:function(){
            var idcomponente=$("#idcompoedi").val();
            var tipcomp=$("#tipcomponente_idcom").val();
            var componente=$("#componente_idedi").val();
            var idequipo=$("#idequicom").val();
            /**terminar proceo ajax */
            $.ajax({
                type:'POST',
                url:'/Home/actualizarcomponente',
                data:{
                    '_token':_token,
                    'id':idcomponente,
                    'tipcomp':tipcomp,
                    'componente':componente,
                    'idequipo':idequipo
                },
                success:function(data){
                    alertify.success(data.msg);
                    $("#editcomponente").modal("hide");
                    actucomponente(data.idequipo);
                }
            });
        }
   });
});
/**Componentes */
function hardware(id){
    $("#componen tr:not(:first-child)").remove();

    $.ajax({
        type:'POST',
        url:'/Home/componentes',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
                console.log(data);
                console.log(data['componente']['0']['nombre']);
                $("#idequcompo").val(data['equipo']['0']['id']);
                $("#numplacacomp").val(data['equipo']['0']['numplaca']);
                var band=0;
                data['componentes'].forEach(ele=>{
                    $('#componen tr:last').after("<tr><td>"+data['tipcomponente'][band]['nombre']+"</td><td>"+data['componente'][band]['nombre']+"</td><td><button class='btn btn-warning'  onclick='editarcompo("+ele.id+")'><i class='fa fa-edit'></i></button><button class='btn btn-danger' onclick='eliminarcompo("+ele.id+")'><i class='fa fa-trash'></i></button></td></tr>"); 
                    band++;
                });
            /**agregar a la tabla */
            $("#componentes").modal("show");
        }
    });
}
function eliminarcompo(id){
    $.ajax({
        type:'POST',
        url:'/Home/eliminarcomponente',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            alertify.success(data.msg);
            actucomponente(data.idequipo);
        }
    });
}
function editarcompo(id){
    $.ajax({
        type:'POST',
        url:'/Home/editarcomponente',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            console.log(data);
            data['componente'].forEach(ele=>{
                $("#idequicom").val(ele.equipos_id);
                $("#idcompoedi").val(ele.id);
                $("#tipcomponente_idcom").val(ele.componentes_id);
            });
            $("#componente_idedi").val(data['tip']);
            $("#editcomponente").modal("show");
        }
    }); 
}
function actucomponente(id){
    $("#componen tr:not(:first-child)").remove();    
    $.ajax({
        type:'POST',
        url:'/Home/componentes',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
                $("#idequcompo").val(data['equipo']['0']['id']);
                $("#numplacacomp").val(data['equipo']['0']['numplaca']);
                var band=0;
                data['componentes'].forEach(ele=>{
                    $('#componen tr:last').after("<tr><td>"+data['tipcomponente'][band]['nombre']+"</td><td>"+data['componente'][band]['nombre']+"</td><td><button class='btn btn-warning'  onclick='editarcompo("+ele.id+")'><i class='fa fa-edit'></i></button><button class='btn btn-danger' onclick='eliminarcompo("+ele.id+")'><i class='fa fa-trash'></i></button></td></tr>"); 
                    band++;
                });
            $("#componentes").modal("show");
        }
    });
}
function traecomponente(id){
    $("#componenteid").empty();
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
function traecomponenteeditar(id){
    $("#componente_idedi").empty();
    var idv=id.value;
    $.ajax({    
        type:'POST',
        url:'/Home/traecomponente',
        data:{
            '_token':_token,
            'id':idv
        },
        success:function(data){
            $("#componente_idedi").append("<option>---Selecione---</option>");
            data.forEach(element=>{
                $("#componente_idedi").append("<option value="+element.id+">"+element.nombre+"</option>");
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
/*hoja de vida*/
function hoja(id){
    $("#softvida").empty();
    $("#hadrvida").empty();
    $.ajax({
        type:'POST',
        url:'/Home/hojavi',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            var idequ="";
            data['equipos'].forEach(element=>{
                $("#numplahv").html("Hoja de vida- "+element.numplaca);
                idequ=element.id;
            });
            for(i=0;i<data['programas'].length;i++){
                $("#hojadevid").append("<tr><td>"+data['programas'][i]+"</td><td>"+data['versiones'][i]+"</td></tr>");
            }
            
            for(var e=0;e < data['componentes'].length;e++){
                $("#hojadevidcompo").append("<tr><td>"+data['tipcomponente'][e]+"</td><td>"+data['componentes'][e]+"</td></tr>");
            }
            var url="/Home/hojavireporte/"+idequ;
            $("#hojaurl").attr('href',url);
            $("#hojadevida").modal('show');
        }
    });
}

/**fin hoja de vida */
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
    $("#progr_id").empty();
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
                        $('#prolist tr:last').after("<tr><td style='text-align:left;'>"+data['programas'][band]+"</td><td style='text-align:left;'>"+nombre+"</td><td>"+element.estado+"</td><td><button class='btn btn-warning' onclick='editarpro("+element.id+")'><i class='fa fa-edit'></i></button><button class='btn btn-danger' onclick='eliminarpro("+element.id+")'><i class='fa fa-trash'></i></button></td></tr>");
                        band+=1;
            });               
            data['equipo'].forEach(element=>{
                $("#ideqpro").val(element.id);
                $("#numplpro").val(element.numplaca);
            });
            $("#progr_id").append("<option>----Selecione----</option>");
            data['pro'].forEach(element=>{
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
                $("#ideqproedi").val(element.equipos_id);
                $("#idregqui").val(element.id);
                $("#version_proidedi").val(element.versionpro_id);
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
        var band=0;
        data['softxequi'].forEach(element=>{
                var nombre="";
                data['version'].forEach(ell=>{ 
                            if(ell.id==element.versionpro_id){
                                nombre=ell.nombre;
                            }
                }); 
                    $('#prolist tr:last').after("<tr><td style='text-align:left;'>"+data['programas'][band]+"</td><td style='text-align:left;'>"+nombre+"</td><td>"+element.estado+"</td><td><button class='btn btn-warning' onclick='editarpro("+element.id+")'><i class='fa fa-edit'></i></button><button class='btn btn-danger' onclick='eliminarpro("+element.id+")'><i class='fa fa-trash'></i></button></td></tr>");
                    band+=1;
        });               
        data['equipo'].forEach(element=>{
            $("#ideqpro").val(element.id);
            $("#numplpro").val(element.numplaca);
        });
        $("#progr_id").empty();

        $("#progr_id").append("<option>----Selecione----</option>");
        data['pro'].forEach(element=>{
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
            data['pro'].forEach(element=>{
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