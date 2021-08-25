$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function() {

  $("#formRegister").validate({
    ignore: [],
    rules: {
      password:         {  required: true, minlength: 6                       },
      password_confirm: {  required: true, minlength: 6, equalTo: "#password" },
      email:            {  required: true, email: true                        }

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
        alertify.confirm('Registrado', 'Confirma que desea realizar el siguiente registro!', function(){
          form.submit(); },function(){  }).set({labels:{ok:'Guardar', cancel: 'Cancelar'}, padding: false});
   }

  });

});

$("#reveal-password" ).on('click',function(e){
  var i = $(this).find('i');
  i.attr('class', i.hasClass('fa fa-eye-open') ? ' fa fa-eye-close' : 'fa fa-eye-open');
  $('#password').attr('type',i.hasClass('fa fa-eye-close') ? 'text' : 'password');
});
$("#reveal-password2").on('click',function(e){
  var i = $(this).find('i');
  i.attr('class', i.hasClass('fa fa-eye-open') ? ' fa fa-eye-close' : 'fa fa-eye-open');
  $('#password_confirm').attr('type',i.hasClass('fa fa-eye-close') ? 'text' : 'password');
});

$("#cliente" ).on('click',function(e){
  $(this).css( "background-color", "#FF3399");
  $(this).css( "color", "#FFFFFF");
  $("#manicurista").css( "background-color", "#f4f4f4");
  $("#manicurista").css( "color", "#666");
  $("#rol").val('C');
});

$("#manicurista" ).on('click',function(e){
  $(this).css( "background-color", "#FF3399");
  $(this).css( "color", "#FFFFFF");
  $("#cliente").css( "background-color", "#f4f4f4");
  $("#cliente").css( "color", "#666");
  $("#rol").val('M');

});

//VALIDACIONES jQuery
jQuery.validator.addMethod("uniqueDB", function(value, element) {
    var result  = true;
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
      type: "POST",
      url: "/emailUnique",
      dataType: "json",
      data: { email : value },
      success: function (data) {  result = data;       }
    });
    return result;
}, "Este usuario ya tiene cuenta");

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
