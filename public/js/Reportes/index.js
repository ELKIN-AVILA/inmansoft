$(document).ready(function(){
    
});

function generaequi(){
    var sede=$("#sedes").val();
    var ano=$("#ano").val();
    $.ajax({
        type:'POST',
        url:'/Reportes/reporteequipos',
        data:{
            '_token':_token,
            'sede':sede,
            'ano':ano
        },
        success:function(data){
            
        }
    });
}