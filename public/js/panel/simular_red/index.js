$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {

});


//OBTENER DATOS DEL USUARIO DESDE LA BUSQUEDA
$("#searchButton").unbind('click');
$("#searchButton").click(function() {
  var campo           = $("#campo").val();
  var campodeBusqueda = $("#campo_busqueda").val();
  if (campo && campodeBusqueda){
    $.ajax({
      url  : "/busquedaUsuarioRed",
      type :"POST",
      data :{ campodeBusqueda : campodeBusqueda, campo : campo },
      dataType: "json",
      beforeSend: function () {
      },
    }).done( function(d) {
      if(d.flag == true){
        alertify.alert('<div align="center">¡Excelente!</div>', '<div align="center">\t\t '+d.mensaje+' </div>',
        function(){  openInfo(d.data);
          $("#campo_busqueda").val('');
          $("#campo").val('');
        });
      }else {
        alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t '+d.mensaje+' </div>',
        function(){
          //clean
        });
      }

    }).fail( function() {
      alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
    }).always( function() {
    });
  }else {
    alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t Debes indicar la busqueda.  </div>',
    function(){
      //clean
    });
  }
});


//OBTENIENDO Data
function openInfo(data){
  var usuario = data.dataUser;
  var sponsor = data.dataRed;

  $("#nombres_html"    ).html(usuario.nombres);
  $("#apellidos_html"  ).html(usuario.apellidos);
  $("#email_html"      ).html(usuario.email);
  $("#telefono_html"   ).html(usuario.telefono);

  $("#estatus_html").html(usuario.status_users_app);
  $("#creado_html" ).html(usuario.created_at);
  $("#rol_html"    ).html(usuario.tp_rol);
  $("#id_user"     ).val(usuario.id);


  if(sponsor.sponsor_nombres && sponsor.sponsor_apellidos){
    $("#sponsor_html").html(sponsor.sponsor_nombres+' , '+sponsor.sponsor_apellidos);
  }else{
    $("#sponsor_html").html(sponsor.sponsor_email);
  }

  $('#modal-show').modal('show');

}


$("#simularRedButton").unbind('click');
$("#simularRedButton").click(function() {

  var dominio = '/simulandoRed/'+$("#id_user").val();
			window.location.href=dominio;

});
