$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function() {
  // alert (hola);
  $("#formEditUsersApp").validate({
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
    return /^[ a-zA-Záéíóúüñ]*$/i.test(value);
}, "Ingrese sólo letras o espacios.");

$.extend( $.validator.messages, {
    required   : "Este campo es obligatorio.",
    remote     : "Por favor, rellena este campo.",
    email      : "Por favor, escribe una dirección de correo válida.",
    url        : "Por favor, escribe una URL válida.",
    date       : "Por favor, escribe una fecha válida.",
    dateISO    : "Por favor, escribe una fecha (ISO) válida.",
    number     : "Por favor, escribe un número válido.",
    digits     : "Por favor, escribe sólo dígitos.",
    creditcard : "Por favor, escribe un número de tarjeta válido.",
    equalTo    : "Por favor, escribe el mismo valor de nuevo.",
    extension  : "Por favor, escribe un valor con una extensión aceptada.",
    maxlength  : $.validator.format( "Por favor, no escribas más de {0} caracteres." ),
    minlength  : $.validator.format( "Por favor, no escribas menos de {0} caracteres." ),
    rangelength: $.validator.format( "Por favor, escribe un valor entre {0} y {1} caracteres." ),
    range      : $.validator.format( "Por favor, escribe un valor entre {0} y {1}." ),
    max        : $.validator.format( "Por favor, escribe un valor menor o igual a {0}." ),
    min        : $.validator.format( "Por favor, escribe un valor mayor o igual a {0}." ),
    nifES      : "Por favor, escribe un NIF válido.",
    nieES      : "Por favor, escribe un NIE válido.",
    cifES      : "Por favor, escribe un CIF válido.",
});


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
}).done( function(d){
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
