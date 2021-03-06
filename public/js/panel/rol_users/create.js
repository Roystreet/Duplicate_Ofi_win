$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$('.js-data-example-ajax').select2({
  ajax: {
    url: '/getUser',
    type: "post",
    dataType: 'json',
    data: function (term, page) {
      return {
        query: term,
        page: page,
        info: term,
        // info:$('#user').val()
        pageLimit: 25,
      }
    },
    processResults: function (data) {
      // Transforms the top-level key of the response object from 'items' to 'results'
      console.log(data);
      return {
        results: $.map(data.data, function(obj) {
          return { id: obj.get_users.id, text: obj.get_users.first_name + ', '+ obj.get_users.first_name +' - '+ obj.get_users.email };
        })
      };
    }
  }
});
$(document).ready(function() {
  // alert (hola);
  $("#formCreateRolUsers").validate({
    ignore: [],
    rules: {
      id_user        :    { required: true       },
      id_tp_rol      :    { required: true       }

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


    $('#buscar').click(function(e){
      e.preventDefault();
      getUser();
  });



    function getUser(){
      if($('#user').val() !=""){
        $.ajax({
          url: "/getUser/",
          type: "post",
          data:{
            info:$('#user').val()
          },
          dataType: "json",
          beforeSend: function() {},
      }).done(function(d) {

          if(d.object=="success"){
              var l = $('#usuarios');
              l.empty();
              $.each(d.data, function (indexInArray, valueOfElement) { 
                  console.log(valueOfElement);
                  l.append('<option value="'+valueOfElement.get_users.email+'">'+valueOfElement.get_users.first_name +' - '+valueOfElement.get_users.last_name+'</option>');
              });
              // $('#usuarios').style.display = "block";
          }
  
      }).fail(function() {
          alert("??Ha ocurrido un error en la operaci??n!"); //alerta del ticket no resgistrado
      }).always(function() {});
      }
    }

    

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
