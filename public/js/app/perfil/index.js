$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

});


//VER Y EDITAR
$("#editarPerfilButton").click(function() {
    $("#verPerfilDiv").hide();
    $("#editarPerfilDiv").show();
});
$("#verPerfilButton").click(function() {
    $("#verPerfilDiv").show();
    $("#editarPerfilDiv").hide();
});
$("#editarRedButton").click(function() {
    $("#verRedDiv").hide();
    $("#editarRedDiv").show();
});
$("#verRedButton").click(function() {
    $("#verRedDiv").show();
    $("#editarRedDiv").hide();
});

//SEND FORM

$("#guardarPerfilButton").click(function() {
  console.log("ñljhgf");

    $("#formPerfil").validate({
        ignore: [],
        rules: {
            first_name: {
                required: true,
                letras: true,
                minlength: 3
            },
            middle_name: {
                required: false,
                letras: true,
                minlength: 3
            },
            last_name: {
                required: true,
                letras: true,
                minlength: 3
            },
            birth: {
                required: true,
                mayorEdad: true
            },
            id_tp_sexo: {
                required: true,
                minlength: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 9,
            },
            id_country: {
                required: true
            },
            id_departament: {
                required: true
            },
            id_city: {
                required: true
            },
            address: {
                required: false
            },
            id_tp_document_identies: {
                required: true
            },
            nro_document: {
                required: true
            }
        },
        onkeyup: false,
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
            $(element).closest('.form-control').addClass('is-invalid');
        },
        highlight: function(element) {
          $(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-control').removeClass('is-invalid');
            $(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: function(form) {

            alertify.confirm('<div align="center">¡Excelente!</div>', '<div align="center">\t\t ¡Confirmas que deseas continuar con la operación!</div>',
                function() {
                    form.submit();
                    $('.waiting_ov').html('<div class="loading">' +
                        '<img src="/imagenes/loader.gif" alt="loading" />' +
                        '<br/>Un momento, por favor espere mientras procesamos...<br/></div>');
                },
                function() {}).set('labels', {
                ok: 'Continuar',
                cancel: 'Cancelar'
            });

        }
    });
});

$("#guardarRedButton").click(function() {
    $("#formRed").validate({
        ignore: [],
        rules: {
            usuario_invitado: {
                required: true,
                letras: true,
                minlength: 3
            },
        },
        onkeyup: false,
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: function(form) {

            alertify.confirm('<div align="center">¡Excelente!</div>', '<div align="center">\t\t ¡Confirmas que deseas continuar con la operación!</div>',
                function() {
                    form.submit();
                    $('.waiting_ov').html('<div class="loading">' +
                        '<img src="/imagenes/loader.gif" alt="loading" />' +
                        '<br/>Un momento, por favor espere mientras procesamos...<br/></div>');
                },
                function() {}).set('labels', {
                ok: 'Continuar',
                cancel: 'Cancelar'
            });

        }
    });
});


//select dependientes
// Revisado
$("#id_country").change(function() {
    $('#id_departament').html('<option value=""> Seleccione un departamento...</option>');
    $('#id_city').html('<option value=""> Seleccione una ciudad...</option>');
    $('#id_distrito').html('<option value=""> Seleccione un distrito...</option>');
    $('#id_tp_document_identies').html('<option value=""> Seleccione un tipo de documento...</option>');

    $.ajax({
        url: '/departament/' + $(this).val(),
        method: 'GET',
        success: function(data) {
            $('#id_departament').html(data.html);
            $('#id_tp_document_identies').html(data.html2);
        }
    });
});
// Revisado
$("#id_departament").change(function() {
  $('#id_city').html('<option value=""> Seleccione una ciudad...</option>');
  $('#id_distrito').html('<option value=""> Seleccione un distrito...</option>');

  $.ajax({
      url: '/city/' + $(this).val(),
      method: 'GET',
      success: function(data) {
          $('#id_city').html(data.html);
      }
  });
});
// Revisado
$("#id_city").change(function() {
  $('#id_distrito').html('<option value=""> Seleccione un distrito...</option>');
  $.ajax({
      url: '/distrito/' + $(this).val(),
      method: 'GET',
      success: function(data) {
          $('#id_distrito').html(data.html);
      }
  });
});
//select dependientes


// Revisado
$("#phone").on('change', function()
{
  var phone = $(this).val();
  var id_users_app = $("#id_users_app").val();
  $.ajax({
      url: "/phoneValidExists",
      type: "POST",
      data: {
          phone: phone,
          id_users_app: id_users_app
      },
      dataType: "json",
  }).done(function(d) {
      console.log(d);
      if (d.object == 'true') {
          $("#phone").val('');
          $("#phone").closest('.form-group').find('.help-block').html(d.mensaje);
          $("#phone").closest('.form-control').addClass('is-invalid');

      } else {
          $("#phone").closest('.form-control').removeClass('is-invalid');
          $("#phone").closest('.form-group').find('.help-block').html('');
      }
  }).fail(function(error) {
      alert("Ha ocurrido un error en la operación!.");
  });
});




$("#usuario_invitado").on('change', function() {


    var usuario_invitado = $(this).val();

    if(usuario_invitado.length < 4){
      $("#usuario_invitado").val('');
      $("#usuario_invitado").closest('.form-control').addClass('is-invalid');
      $("#usuario_invitado").closest('.form-group').find('.help-block').html('El usuario debe contener minimo 4 carácteres');
      return false;
    }
    var id_red_users_app = $("#id_red_users_app").val();

    $.ajax({
        url: "/usuarioValidExists",
        type: "POST",
        data: {
            usuario_invitado: usuario_invitado,
            id_red_users_app: id_red_users_app
        },
        dataType: "json",
    }).done(function(d) {
        console.log(d);
        if (d.object == 'true') {
            $("#usuario_invitado").val('');
            $("#usuario_invitado").closest('.form-control').addClass('is-invalid');
            $("#usuario_invitado").closest('.form-group').find('.help-block').html(d.mensaje);

        } else {
            $("#usuario_invitado").closest('.form-control').removeClass('is-invalid');
            $("#usuario_invitado").closest('.form-control').addClass('is-valid');
            $("#usuario_invitado").closest('.form-group').find('.help-block').html('Usuario disponible');
        }
    }).fail(function(error) {
        alert("Ha ocurrido un error en la operación!.");
    });

});



//Revisado
$.validator.addMethod("letras", function(value, element) {
    return /^[ a-zA-Záéíóúüñ]*$/i.test(value);
}, "Ingrese sólo letras o espacios.");

$.validator.addMethod("mayorEdad", function(value, element) {
    var fechanacimiento = moment(value);
    if (!fechanacimiento.isValid())
        return false;
    var years = moment().diff(fechanacimiento, 'years');
    if (years >= 18)
        return true;

}, "Debes ser mayor de 18 años.");

$.extend($.validator.messages, {
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
    maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
    minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
    rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
    range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
    max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
    min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
    nifES: "Por favor, escribe un NIF válido.",
    nieES: "Por favor, escribe un NIE válido.",
    cifES: "Por favor, escribe un CIF válido.",
});
