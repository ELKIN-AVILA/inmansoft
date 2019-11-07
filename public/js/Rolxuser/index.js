$(document).ready(function(){

});
var _token=$('input[name=_token]').val();
function nuevo(){
    $("#nuevo").modal("show");
}
function guardar(){
    var rol=$("#rol_id").val();
    var usuario=$("#usuarios_id").val();
    $.ajax({
        type:'POST',
        url:'/Rolxuser/asignar',
        data:{
            '_token':_token,
            'rol_id':rol,
            'usuario_id':usuario
        },
        success:function(data){
            alert(data);
            location.reload();
        }
    })
}