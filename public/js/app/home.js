$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var datos_invitado;

$(document).ready(function() {
  $(".generalbutton").attr("disabled", true);
  $("#usuario_invitado").click();


  $("#formUserRol").validate({

    ignore: [],
    rules: {
      tp_invited       :  {  required: true },
      id_user_sponsor  :  {  required: true },
      tp_rol           :  {  required: true },
    },
    onkeyup :false,
    errorPlacement : function(error, element) {
     $(element).closest('.form-group').find('.help-block').html(error.html());
    },
    highlight : function(element) {
     $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
     $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
     $(element).closest('.form-group').find('.help-block').html('');
    },
    submitHandler: function(form) {

      alertify.confirm('<div align="center">¡Excelente!</br>¡Estas mas cerca de terminar tu registro!</div>', '<div align="center">\t\t Confirmas que deseas continuar con la operación!</div>',
      function(){
        form.submit();
        $('.waiting_ov').html('<div class="loading">'+
                              '<img src="/images/loading.gif" alt="loading" />'+
                              '<br/>Un momento, por favor espere mientras procesamos...<br/></div>');
      }
      , function(){}).set('labels', {ok:'Continuar', cancel:'Cancelar'});

    }


  });


});




//GETION DE RED
$("#confirm_sponsor" ).on('click',function(e){
  $('#confirm_sponsor').css('color','green');
  $("#id_user_sponsor").val(datos_invitado.id);

  if ($("#id_user_sponsor").val() != ""){
    $(".cuenta_user").show();

    // PROMOTOR DE MARCA
    if(datos_invitado.rol_user.id_tp_rol == 2){
      $(".btn-cuenta").show();
      $("#promotor").show();
      $("#conductor").show();
      $("#pasajero").show();
    }
    else if (datos_invitado.rol_user.id_tp_rol == 3) {
      $(".btn-cuenta").hide();
      $("#conductor").show();
      $("#pasajero").show();


    }
    else if (datos_invitado.rol_user.id_tp_rol == 4) {
      $(".btn-cuenta").hide();

      $("#pasajero").show();

    }else {
      $(".btn-cuenta").hide();
    }

  }else{
    $(".cuenta_user").hide();
  }

  $("#confirm_case").html('Confirmado');
  $(".tpcampos").hide();
  $(".campo_sponsor").hide();

});


$("#search_again"    ).on('click',function(e){
  $(".generalbutton").attr("disabled", true);

  $("#sponsor").closest('.form-group').removeClass('has-error').addClass('has-default');
  $("#sponsor").closest('.form-group').removeClass('has-success').addClass('has-default');
  $("#sponsor").closest('.form-group').find('.help-block').html('');

  var i = $("#confirm_sponsor").find('i');
  i.attr('class', i.hasClass('fa fa-square-o') ? 'fa fa-check-square-o' : 'fa fa-square-o');
  $("#confirm_case").html('Confirmar');

  // TABLE
  $("#name_sponsor_data_nombres").html('');
  $("#name_sponsor_data_apellidos").html('');
  $("#confirm_case").html('Confirmar');

  // ROW
  $(".tp_campos_row").show();
  $(".search_row"   ).hide();
  $(".table_data"   ).hide();
  $(".cuenta_user"  ).hide();



  //CAMPOS
  $("#tp_rol").val('');
  $("#sponsor").val('');
  $("#tp_invited").val('');
  $("#id_user_sponsor").val('');

  //VAR DE DATOS
  $(".btn-type-sponsor").css( "background-color", "#f4f4f4");
  $(".btn-type-sponsor").css( "color", "#666");
});
$(".btn-type-sponsor").on('click',function(e){

  $("#sponsor").closest('.form-group').removeClass('has-error').addClass('has-default');
  $("#sponsor").closest('.form-group').removeClass('has-success').addClass('has-default');
  // TABLE
  $("#name_sponsor_data_nombres").html('');
  $("#name_sponsor_data_apellidos").html('');
  $("#confirm_case").html('Confirmar');

  // ROW
  $(".search_row").hide();
  $(".table_data").hide();

  //CAMPOS
  $("#tp_invited").val('');
  $("#id_user_sponsor").val('');

  //VAR DE DATOS
  $(".btn-type-sponsor").css( "background-color", "#f4f4f4");
  $(".btn-type-sponsor").css( "color", "#666");

  //GESTION
  var campo = $(this).attr('id');
  $("#"+campo).css( "background-color", "#00a65a");
  $("#"+campo).css( "color", "#FFFFFF");
  $("#tp_invited").val(campo);
  $(".search_row").show();

});
$("#fa_search"       ).on('click',function(e){
  var dato    = $("#sponsor").val();
  var tpcampo = $("#tp_invited").val();

  $.ajax({
      url  : "/searchSponsor",
      type :"POST",
      data :
      {
        dato    : dato,
        tpcampo : tpcampo
      },

      dataType: "json",
      beforeSend: function () {
        },
  }).done( function(d) {

    if(d.object == 'success'){

      datos_invitado = d.data;

      $("#sponsor").closest('.form-group').removeClass('has-error').addClass('has-default');
      $("#sponsor").closest('.form-group').removeClass('has-success').addClass('has-default');

      $("#name_sponsor_data_nombres").html(d.data.first_name+' '+d.data.middle_name);
      $("#name_sponsor_data_apellidos").html(d.data.last_name);
      $("#confirm_case").html('Confirmar');
      $(".tp_campos_row").hide();
      $(".search_row").hide();
      $(".table_data").show();

    }
    else{
      $("#sponsor").closest('.form-group').removeClass('has-success').addClass('has-error');
      $("#sponsor").closest('.form-group').find('.help-block').html(d.mensaje);
      $("#name_sponsor_data_nombres").html('');
      $("#name_sponsor_data_apellidos").html('');
      $("#confirm_case").html('Confirmar');
    }

    console.log(d);

  }).fail( function() {
    alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
  }).always( function() {
  });
});
$(".btn-cuenta").on('click',function(e){

  //CAMPOS
  $("#tp_rol").val('');

  //VAR DE DATOS
  $(".btn-cuenta").css( "background-color", "#f4f4f4");
  $(".btn-cuenta").css( "color", "#666");

  //GESTION
  var campo = $(this).attr('id');
  $("#"+campo).css( "background-color", "#00a65a");
  $("#"+campo).css( "color", "#FFFFFF");
  $("#tp_rol").val($("#"+campo).data('id'));
  $(".generalbutton").attr("disabled", false);


});
//GETION DE RED



$.extend( $.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida.",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    dateISO: "Por favor, escribe una fecha (ISO) válida.",
    number: "Por favor, escribe un número válido.",
    digits: "Por favor, escribe sólo dígitos.",
    creditcard: "Por favor, escribe un número de tarjeta válido.",
    equalTo: "Por favor, escribe el mismo valor de nuevo.",
    extension: "Por favor, escribe un valor con una extensión aceptada.",
    maxlength: $.validator.format( "Por favor, no escribas más de {0} caracteres." ),
    minlength: $.validator.format( "Por favor, no escribas menos de {0} caracteres." ),
    rangelength: $.validator.format( "Por favor, escribe un valor entre {0} y {1} caracteres." ),
    range: $.validator.format( "Por favor, escribe un valor entre {0} y {1}." ),
    max: $.validator.format( "Por favor, escribe un valor menor o igual a {0}." ),
    min: $.validator.format( "Por favor, escribe un valor mayor o igual a {0}." ),
    nifES: "Por favor, escribe un NIF válido.",
    nieES: "Por favor, escribe un NIE válido.",
    cifES: "Por favor, escribe un CIF válido.",
});
