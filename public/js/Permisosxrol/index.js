$(document).ready(function(){

});
var _token=$('input[name=_token]').val();
function nuevo(){
    $("#nuevo").modal("show");
}
function guardar(){
    var nombre=$("#nombre").val();
    var rol=$("#rol_id").val();
    var permiso=$("#permisos_id").val();
    $.ajax({
        type:'POST',
        url:'/Permisosxrol/asignar',
        data:{
            '_token':_token,
            'rol_id':rol,
            'permiso_id':permiso
        },
        success:function(data){
            alert(data);
            location.reload();
        }
    })
}