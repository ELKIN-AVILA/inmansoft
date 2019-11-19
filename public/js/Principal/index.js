$(document).ready(function(){
/**imagenes*/


/**fin imagenes */
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
                    console.log(data);
                    
                        $("#contenido").empty();
                        var html="";
                        var cont=-1;
                        var nmp="";
                        data['equipos'].forEach(element=>{
                            cont++;
                            switch(data['tipoequ'][cont]['0']['id']){
                                case 1:
                                    nmp="img/pc.png";
                                    break;
                                case 2:
                                    nmp="img/impresora.png";
                                    break;
                                case 3:
                                    nmp="img/portatil.png";
                                    break;
                                case 4:
                                    nmp="img/tv.png";
                                    break;
                                case 5:
                                    nmp="img/scan.png";
                                    break;
                                case 6:
                                    nmp="img/vb.png";
                                    break;
                                case 7:
                                    nmp="img/imprecaja.jpg";
                                    break;
                                case 8:
                                    nmp="img/micropc.png";
                                    break;
                                case 9:
                                    nmp="img/impreradic.jpg";
                                    break;
                                case 10:
                                    nmp="img/imprecard.jpg";
                                    break;
                            }
                           
                            console.log(data['tipoequ'][cont]['0']['nombre']);
                            html+="<div class='col-sm-4'>";
                            html+="<div class='panel panel-primary'>";
                            html+="<div class='panel-heading'>Numero de placa "+element['0']['numplaca']+"</div>";
                            html+="<div class='panel-body' style='text-align:center;'>";
                            html+="<h5 style='text-align:center;'>"+data['tipoequ'][cont]['0']['nombre']+"</h5>";
                            html+="<img src="+nmp+" style='height:96px;'>";
                            html+="<div>";
                            html+="<button class='btn btn-success' onclick='programas("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Software'><i class='fa fa-laptop' style='font-size: xx-large'></i></button>";
                            html+="<button class='btn btn-warning' onclick='hardware("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hardware'><i class='fa fa-wrench' style='font-size: xx-large'></i></button>";
                            html+="<button class='btn btn-info' onclick='hoja("+element['0']['id']+")' data-toggle='tooltip' data-placement='top' title='Hoja de vida'><i class='fa fa-folder-open-o' style='font-size: xx-large'></i></button>";
                            html+="<button onclick='mantenimientos("+element['0']['id']+");' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Mantenimiento'><i class='fa fa-cog' style='font-size: xx-large'></i></button>"
                            html+="</div>";
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
   $("#formuldetmante").validate({
        rules:{
            descripcionmante:{
                required:true
            }
        },
        submitHandler:function(){
            var descripcion=$("#descripcionmante").val();
            var idmante=$("#idequimante").val();
            $.ajax({
                type:'POST',
                url:'/Home/guardardetmante',
                data:{
                    '_token':_token,
                    'idmante':idmante,
                    'descripcion':descripcion
                },
                success:function(data){
                    alertify.success(data.msg);
                    $("#descripcionmante").val(" ");
                    mantenimientos(data['idequipo']['0']['equipos_id']);
                    $("#detmantenimiento").modal('hide');
                }
            }); 
        }
   });
   $("#formulmante").validate({
        rules:{
            tipmante_id:{
                required:true
            }
        },
        submitHandler:function(){
            var idequipoman=$("#idequipoman").val();
            var tipmante=$("#tipmante_id").val();
            var fecha=$("#fechamante").val();
            $.ajax({
                type:'POST',
                url:'/Home/guardarmantenimiento',
                data:{
                    '_token':_token,
                    'idequipo':idequipoman,
                    'tipmante_id':tipmante,
                    'fecha':fecha
                },
                success:function(data){
                    alertify.success(data.msg);
                    $("#tipmante_id").val(" ");
                    mantenimientos(data.idequipo);
                    $("#nuevoman").modal("hide");
                }
            });
        }
   });
   /**fotos mantenimiento */
    $("#formulariofotmante").submit(function(e){
        e.preventDefault();
    }).validate({
        rules:{
        	fotoid:{
                required:true
            }
    },
    submitHandler:function(){
        var formData = new FormData($('#formulariofotmante') [0]);
        var token = $('input[name=_token]').val();

        $.ajax({
            headers: {'X-CSRF-TOKEN':token},
            type:'POST',
            url:'/Home/guardarfotos',
            contentType: false,
            processData: false,
            data:formData,
            success:function(data){
                alertify.success(data.msg);
                actufotos(data.id);
                $("#observafoto").val(' ');
                document.getElementById("fotoid").value = "";
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
    $("#mantenire > tbody").empty();

    $.ajax({
        type:'POST',
        url:'/Home/mantenimientos',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            $("#idequ").val(data['idequipo']);
            var i=0;
            data['mantenimientos'].forEach(element=>{
                i++;
                tipo="";
                if(element.tipo=="P"){
                    tipo="Programada";
                }else{
                    tipo="No Programada";
                }
                if(element.estado=='N'){
                    $("#manteni > tbody:last-child").append("<tr><td>"+i+"</td><td>"+element.fecha+"</td><td>"+tipo+"</td><td><button  class='btn btn-success' onclick='manteni("+element.id+");'>+</button></td></tr>");
                }else{
                    $("#mantenire > tbody:last-child").append("<tr><td>"+i+"</td><td>"+element.fecha+"</td><td>"+tipo+"</td><td><button  class='btn btn-success' onclick='infomante("+element.id+");'><i class='fa fa-info-circle'></i></button><button class='btn btn-info' onclick='fotos("+element.id+");'><i class='fa fa-image'></i></button><a class='btn  btn-danger' href='/Home/infomantepdf/"+element.id+"'><i class='fa fa-file-pdf-o'></i></a></td></tr>");

                }
            });
            $("#mantenimientos").modal("show");
        }
    });
}
/**Info mantenimiento */
const infomante=(id)=> $.ajax({
            type:'POST',
            url:'/Home/infomantenimiento',
            data:{
                '_token':_token,
                'id':id
            },
            success:function(data){ 
                $("#respomanteinfo").html(data['usuario']['name']);
                $("#fechamanteinfo").html(data['mantenimiento']['fecha']);
                $("#tipomanteinfo").html(data['tipmante']['nombre']);
                data['detmantenimiento'].forEach(el=>{
                    $("#descripcionmanteinfo").html(el.descripcion);
                });
                $("#infomantenimiento").modal("show");
            }
});

function manteni(id){
    $("#idequimante").val(id);
    $("#detmantenimiento").modal("show");
}
function actufotos(id){
    $("#fotomante > tbody").empty();
    $("#idequifotos").val(id);
    $.ajax({
        type:'POST',
        url:'/Home/traefotos',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(ele=>{
                $("#fotomante > tbody:last-child").append("<tr><td><img style='width:300px;heigth:168px;' src='img/mantenimientos/"+ele.url+"'></td><td>"+ele.observacion+"</td><td><button  class='btn btn-success' onclick='obserfoto("+ele.id+");'><i class='fa fa-info'></i></button></td></tr>");
            });
        }
    })
}
function fotos(id){
    $("#fotomante > tbody").empty();
    $("#idequifotos").val(id);
    $.ajax({
        type:'POST',
        url:'/Home/traefotos',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            data.forEach(ele=>{
                $("#fotomante > tbody:last-child").append("<tr><td><img style='width:300px;heigth:168px;' src='img/mantenimientos/"+ele.url+"'></td><td>"+ele.observacion+"</td><td><button  class='btn btn-success' onclick='obserfoto("+ele.id+");'><i class='fa fa-info'></i></button></td></tr>");
            });
        }
    })
    $("#fotosmantenimiento").modal("show");
}
function nuevoman(){
    var idequipo=$("#idequ").val();
    $("#idequipoman").val(idequipo);
    
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
            console.log(data);
            $("#equipos").empty();
            var html="";
            
            data['equipos'].forEach(element=>{
                    html+="<div class='col-sm-4'>";
                    html+="<div class='panel panel-primary'>";
                    html+="<div class='panel-heading'>Numero placa:"+element['0']['numplaca']+"</div>";
                    html+="<div class='panel-body'>";
                 
                    html+="<button class='btn btn-primary'>Mantenimientos</button>"; 
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
