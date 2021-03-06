$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function() {
  // alert (hola);
  $("#id_country").val('').trigger('change');
  $("#formCreateUsersApp").validate({
    ignore: [],
    rules: {
      telefono             :    { required: true, number  : true, minlength: 9  },
      nombres              :    { required: true, letras  : true, minlength: 3  },
      apellidos            :    { required: true, letras  : true, minlength: 3  },
      email                :    { required: true, email   : true                },
      f_nacimiento         :    { required: true                                },
      id_tp_sexo           :    { required: true                                },
      id_country           :    { required: true                                },
      id_departament       :    { required: true                                },
      id_city              :    { required: true                                },
      id_status_users_app  :    { required: true                                }
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


$("#id_country"   ).change(function(){
  $('#id_departament').html('<option value=""> Seleccione un departamento...</option>');
  $('#id_city'       ).html('<option value=""> Seleccione una ciudad...</option>');
  $('#id_distrito'   ).html('<option value=""> Seleccione un distrito...</option>');


  $.ajax({
    url: '/departament/'+$(this).val(),
    method: 'GET',
    success: function(data) {
      $('#id_departament').html(data.html);
    }
  });
});

$("#id_departament").change(function(){
  $('#id_city').html('<option value=""> Seleccione una ciudad...</option>');
  $('#id_distrito').html('<option value=""> Seleccione un distrito...</option>');

  $.ajax({
    url: '/city/'+$(this).val(),
    method: 'GET',
    success: function(data) {
      $('#id_city').html(data.html);
    }
  });
});

$("#id_city"       ).change(function(){
  $('#id_distrito').html('<option value=""> Seleccione un distrito...</option>');

  $.ajax({
    url: '/distrito/'+$(this).val(),
    method: 'GET',
    success: function(data) {
      $('#id_distrito').html(data.html);
    }
  });
});


$.validator.addMethod("letras", function(value, element) {
    return /^[ a-zA-Z??????????????]*$/i.test(value);
}, "Ingrese s??lo letras o espacios.");

$.extend( $.validator.messages, {
    required   : "Este campo es obligatorio.",
    remote     : "Por favor, rellena este campo.",
    email      : "Por favor, escribe una direcci??n de correo v??lida.",
    url        : "Por favor, escribe una URL v??lida.",
    date       : "Por favor, escribe una fecha v??lida.",
    dateISO    : "Por favor, escribe una fecha (ISO) v??lida.",
    number     : "Por favor, escribe un n??mero v??lido.",
    digits     : "Por favor, escribe s??lo d??gitos.",
    creditcard : "Por favor, escribe un n??mero de tarjeta v??lido.",
    equalTo    : "Por favor, escribe el mismo valor de nuevo.",
    extension  : "Por favor, escribe un valor con una extensi??n aceptada.",
    maxlength  : $.validator.format( "Por favor, no escribas m??s de {0} caracteres." ),
    minlength  : $.validator.format( "Por favor, no escribas menos de {0} caracteres." ),
    rangelength: $.validator.format( "Por favor, escribe un valor entre {0} y {1} caracteres." ),
    range      : $.validator.format( "Por favor, escribe un valor entre {0} y {1}." ),
    max        : $.validator.format( "Por favor, escribe un valor menor o igual a {0}." ),
    min        : $.validator.format( "Por favor, escribe un valor mayor o igual a {0}." ),
    nifES      : "Por favor, escribe un NIF v??lido.",
    nieES      : "Por favor, escribe un NIE v??lido.",
    cifES      : "Por favor, escribe un CIF v??lido.",
});
