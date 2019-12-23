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
            console.log('ok');
            var blob = new Blob([data], { type: 'application/pdf' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "report.pdf";
            link.click();
        }
    });
}