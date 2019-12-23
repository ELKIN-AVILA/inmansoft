$(document).ready(function(){
    $("#egreso").hide();
});
function nuevo(){
    $("#nuevo").modal('show');
}
function guardar(){
    var numplaca=$("#numplaca").val();
    var tipequipo=$("#tipequipo_id").val();
    var marcaequipo=$("#marcaequi_id").val();
    var modelequipo=$("#modelequi_id").val();
    var serial=$("#serial").val();
    var fechacompra=$("#fechacompra").val();
    var proveedor=$("#proveedores_id").val();
    var valcompra=$("#valcompra").val();
    var estado=$("#estado").val();
    var fechaegreso;
    
    if(estado==2){
        fechaegreso=$("#fechaegreso").val();
    }
    /**val fechas */
    if(fechaegreso<=fechacompra){
        alertify.error("la fecha de egreso no puede ser menor a la fecha de compra");
    }else{
    $.ajax({
        type:'POST',
        url:'/Equipos/guardar',
        data:{
            '_token':_token,
            'numplaca':numplaca,
            'tipequipo':tipequipo,
            'marcaequipo':marcaequipo,
            'modelequipo':modelequipo,
            'serial':serial,
            'valcompra':valcompra,
            'fechacompra':fechacompra,
            'proveedor':proveedor,
            'estado':estado,
            'fechaegreso':fechaegreso
        },
        success:function(data){
            alertify.success(data);
            location.reload();
        }
    })
    }
}
function egreso(val){
    var valor=val.value;
    if(valor==2){
        $("#egreso").show();
    }else{
        $("#egreso").hide();
    }
  
}
function infor(id){
    $.ajax({
        type:'POST',
        url:'/Equipos/informacion',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            
            var estado;
            if(data['equipos'][0]['fechaegre']!=null){
                var fechaegreso=data['equipos'][0]['fechaegre'];
                $("#fechaegresoinfo").html("Fecha de egreso:"+ fechaegreso);
            }else{
                $("#fechaegresoinfo").html("");
            }
            $("#nombreequipo").html("Numero de Placa-"+data['equipos'][0]['numplaca']);
            if(data['equipos'][0]['estado']=="A"){
                estado="ACTIVO";
            }else{
                estado="INACTIVO";
            }
            $("#estadoinfo").html("Estado del equipo:"+estado);
            $("#tipoequipoinfo").html("Tipo de Equipo:"+data['tipequipo'][0]['nombre']);
            $("#marcaequipoinfo").html("Marca de Equipo:"+data['marcaequipo'][0]['nombre']);
            $("#modeloequipoinfo").html("Modelo de Equipo:"+data['modelequipo'][0]['nombre']);
            $("#serialinfo").html("Serial:"+data['equipos'][0]['serial']);
            $("#fechacomprainfo").html("Fecha Compra:"+data['equipos'][0]['fechacompra']);
            $("#valorcomprainfo").html("Valor Compra:"+data['equipos'][0]['valcompra']);
            $("#proveedorinfo").html("Proveedor:"+data['proveedores'][0]['razonsoc']);
            $("#informacion").modal('show');
        }
    })
}
function editar(id){
    $.ajax({
        type:'POST',
        url:'/Equipos/editar',
        data:{
            '_token':_token,
            'id':id
        },
        success:function(data){
            var estado;
            data.forEach(element => {
                    $("#idedi").val(element.id);
                    if(element.estado=="A"){
                        estado=1;
                    }else{
                        estado=2;
                    }
                    $("#estadoedi").val(estado);
                    $("#numplacaedi").val(element.numplaca);
                    $("#tipequipo_idedi").val(element.tipequipo_id);
                    $("#marcaequi_idedi").val(element.marcaequi_id);
                    $("#modelequi_idedi").val(element.modelequi_id);
                    $("#serialedi").val(element.serial);
                    $("#fechacompraedi").val(element.fechacompra);
                    $("#valcompraedi").val(element.valcompra);
                    $("#proveedores_idedi").val(element.proveedores_id);
                    if(element.fechaegre !=''){
                        $("#egresoedi").hide();
                    }else{
                        $("#fechaegresoedi").val(element.fechaegre);
                    }
            });
            $("#editar").modal('show');
        }
    });
}
function actualizar(){
    var id=$("#idedi").val();
    var numplaca=$("#numplacaedi").val();
    var tipequipo=$("#tipequipo_idedi").val();
    var marcaequipo=$("#marcaequi_idedi").val();
    var modelequi=$("#modelequi_idedi").val();
    var valcompra=$("#valcompraedi").val();
    var serial=$("#serialedi").val();
    var fechacompra=$("#fechacompraedi").val();
    var proveedores=$("#proveedores_idedi").val();
    var fechaegre=$("#fechaegresoedi").val();
    
    $.ajax({
        type:'POST',
        url:'/Equipos/actualizar',
        data:{
            '_token':_token,
            'id':id,
            'numplaca':numplaca,
            'tipequipo':tipequipo,
            'marcaequipo':marcaequipo,
            'modelequipo':modelequi,
            'serial':serial,
            'fechacompra':fechacompra,
            'valcompra':valcompra,
            'proveedores':proveedores,
            'fechaegre':fechaegre
        },
        success:function(data){
            alertify.success(data);
            location.reload();
        }
    })
}
function traemodelo(id){
    $("#modelequi_id").empty();
    var idv=id.value;
	$.ajax({
		type:'POST',
		url:'/Equipos/traemodelo',
		data:{
			'_token':_token,
			'id':idv
		},
		success:function(data){
			$("#modelequi_id").append("<option value=''>---Selecione---</option>");
			data.forEach(el=>{
				$("#modelequi_id").append("<option value="+el.id+">"+el.nombre+"</option>");
			});
		}
	});
}

