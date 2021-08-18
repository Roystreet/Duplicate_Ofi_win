$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

getDataUsuario();
function getDataUsuario(){
    $.ajax({
        url  : "/administracion/usuario/obtener",
        type :"POST",
        data :{ id : $('#id').val() },
        dataType: "json",
        beforeSend: function () {
          $('.loader-container').show(300);
          },
    }).done( function(d) {
      $('.loader-container').hide(300);
      if(d.object == "success"){
        $('#user').val(d.data.username);
        $('#email').val(d.data.email);
        $('#first_name').val(d.data.first_name);
        $('#last_name').val(d.data.last_name);
        $('#address').val(d.data.distrito);
      }


    }).fail( function() {
      alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
    }).always( function() {
    });
}

function restaurar(){
  if($('#password').val() == ""){
    alert('el campo esta vacío.');
    return false;
  }
  $.ajax({
    url  : "/administracion/usuario/cambiar/contrasena",
    type :"POST",
    data :{
    id : $('#id').val(),
    password : $('#password').val(),
  },
    dataType: "json",
    beforeSend: function () {
      $('.loader-container').show(300);
      },
}).done( function(d) {

  if(d.object == "success"){
    $('.loader-container').hide(300);
    alert(d.message);
  }


}).fail( function() {
  alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
}).always( function() {
});
}

function restaurar_x_correo(){

  $.ajax({
    url  : "/administracion/usuario/correo/contrasena/restaurar",
    type :"POST",
    data :{
    id : $('#id').val(),
  },
    dataType: "json",
    beforeSend: function () {
      $('.loader-container').show(300);
      },
}).done( function(d) {
  $('.loader-container').hide(300);
  if(d.object == "success"){

  }else{
    alert(d.message);
  }


}).fail( function() {
  alert("¡Ha ocurrido un error en la operación!");
}).always( function() {
});
}
