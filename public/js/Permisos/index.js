$(document).ready(function(){

});
var _token=$('input[name=_token]').val();
function nuevo(){
    $("#nuevo").modal("show");
}
function guardar(){
    var nombre=$("#nombre").val();
    $.ajax({
        type:'POST',
        url:'/Permisos/guardar',
        data:{
            '_token':_token,
            'nombre':nombre
        },
        success:function(data){
            alert(data);
            location.reload();
        }
    })
}