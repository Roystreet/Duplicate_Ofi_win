$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;
var sponsorPadre  = $("#sponsorPadre").val();
var totalRed;
var totalDirectos;
var totalIndirectos;
var ultimoNivel = 2

$(document).ready(function() {
  $('#siguiente').prop("disabled", true);

  $("#nivelBusqueda").val(1);
  table = $('#redDetalles-table').DataTable({
           'responsive'  : false,
           'autoWidth'   : true,
           'destroy'     : true,
           'deferRender' : true,
           'language': {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
              "infoFiltered": "(Filtrado de _MAX_ total entradas)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
            },

      });
  getDirectos(sponsorPadre);
  getTotalRedCompleta(sponsorPadre);

});

//OBTENER RED TOTAL NUMEROS.
function getTotalRedCompleta(){
  $.ajax({
      url  : "/totalRedSimple",
      type :"POST",
      data :{ sponsor : sponsorPadre },
      dataType: "json",
      beforeSend: function () {
        },
  }).done( function(d) {
    if(d.flag == true){

      var array = d.data;
          if(array[1].cant == 0){
            $('#siguiente').prop("disabled", true);
          }else {
            $('#siguiente').prop("disabled", false);
          }

      $("#totalRed").html(d.total_red);
      if(array[0]){
        $("#totalRedDirecta").html((array[0])?   array[0].cant: 0);
        $("#totalRedInDirecta").html((array[1])? array[1].cant : 0);
      }else{
        $("#totalRedDirecta").html((array)?   array.cant: 0);
        $("#totalRedInDirecta").html(0);

      }

    }

  }).fail( function() {
    alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
  }).always( function() {
  });
}

//OBTENER DIRECTOS
function getDirectos() {
  $.ajax({
      url  : "/redDirecta",
      type :"POST",
      data : { sponsor : sponsorPadre },
      dataType: "json",
      beforeSend: function () {
        },
  }).done( function(d) {
    reloadTable(d.data);
  }).fail( function() {
    alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
  }).always( function() {
  });
}

//CAMBIO DE NIVEL
function getDataNivel(nivel){

  $.ajax({
      url  : "/redBusquedaNivel",
      type :"POST",
      data : { sponsor : sponsorPadre, nivelBusqueda : nivel },
      dataType: "json",
      beforeSend: function () {
        },
  }).done( function(d) {
    reloadTable(d.data);
  }).fail( function() {
    alert("¡Ha ocurrido un error en la operación!");//alerta del ticket no resgistrado
  }).always( function() {
  });
}

//REFRESH DE TABLE
function reloadTable(data) {
  table = $('#redDetalles-table').DataTable({
   'data' : data,
   'responsive'    : false,
   'autoWidth'     : true,
   'destroy'       : true,
   'deferRender'   : true,
   'language'      : {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
      }
    },
   'fnRowCallback' : function(nRow, aData, iDisplayIndex){
      $("td:first", nRow).html(iDisplayIndex +1);
      return nRow;
    },
   'columns'       : [
      {data:"id",
      "render": function (data, type, row) {
        return data;
      }},
      {data:"get_users_invitado",
      "render": function (data, type, row) {
       return (data) ? (data.nombres)? data.nombres : '-' : '-';
      }},
      {data:"get_users_invitado",
      "render": function (data, type, row) {
       return (data) ? (data.apellidos)? data.apellidos : '-' : '-';
      }},
      {data:"codigo_invitado",
      "render": function (data, type, row) {
       return (data) ? data : '-';
      }},
      {data:"usuario_invitado",
      "render": function (data, type, row) {
       return (data) ? data : '-';
      }},
      {data:"get_users_sponsor_codigo",
      "render": function (data, type, row) {
       return (data) ? data.codigo_invitado : '-';
     }},
      {data:"id",
     "render": function (data, type, row) {
       return ($("#nivelBusqueda").val()) ? $("#nivelBusqueda").val() : '-';
     }},
      {data:"id",
      "render": function (data, type, row) {
       return '<a id="getData" data-id="'+row.id_users+'"><i class="fa fa-eye"><i></a>';
     }},
      {data:"get_status_red",
      "render": function (data, type, row) {
       return (data)? data.descripcion : '-';
      }}
    ],
  });
}


//OBTENIENDO Data
function openInfo(data){
  var usuario = data.dataUser;
  var sponsor = data.dataRed;
  $(".directosDetails"  ).hide();
  $(".indirectosDetails").hide();

  $(".nombres_html"    ).html(usuario.nombres);
  $(".apellidos_html"  ).html(usuario.apellidos);
  $(".rol_html"    ).html(usuario.tp_rol);
  $(".usuario_invitado_html").html(sponsor.usuario_invitado);
  $(".codigo_invitado_html" ).html(sponsor.codigo_invitado);


  if(data.nivel == 1){
    $(".directosDetails").show();
    $(".email_html"      ).html(usuario.email);
    $(".telefono_html"   ).html(usuario.telefono);
    $(".estatus_html").html(usuario.status_users_app);
    $(".creado_html" ).html(usuario.created_at);
  }else{
    $(".indirectosDetails").show();
  }

  $(".nivel_html"  ).html(data.nivel);
  $("#nivelModal"  ).val(data.nivel);


  if(sponsor.sponsor_nombres && sponsor.sponsor_apellidos){
    $(".sponsor_html").html(sponsor.sponsor_nombres+' , '+sponsor.sponsor_apellidos);
  }else{
    $(".sponsor_html").html(sponsor.sponsor_email);
  }

  $('#modal-show').modal('show');

}




//IR ENTRE NIVELES
$(".nivel").unbind('click');
$(".nivel").click(function() {
  var paso = $(this).attr('data-paso');
  if(paso == 'siguiente'){

    var nivel   = parseInt ($("#nivelBusqueda").val()) + 1;

    $("#nivelBusqueda").val(nivel);
    $("#level").html('Nivel '+nivel);
    getDataNivel(nivel);

  }else{

    var nivel   = parseInt ($("#nivelBusqueda").val()) - 1;

    $("#nivelBusqueda").val(nivel);
    $("#level").html('Nivel '+nivel);

    getDataNivel(nivel);
  }

  if(nivel > 1){
    $('#anterior').prop("disabled", false);
    if (nivel == ultimoNivel) {
      $('#siguiente').prop("disabled", true);
    }
  }
  if(nivel < ultimoNivel){
    $('#siguiente').prop("disabled", false);
  }
  if (nivel == 1){
    $('#anterior').prop("disabled", true);
  }
});

//IR ENTRE NIVELES DESDE LA BUSQUEDA
$("#searchlevel").unbind('click');
$("#searchlevel").click(function() {
  var nivel = $("#nivelModal").val();

  $("#nivelBusqueda").val(nivel);
  getDataNivel(nivel);
  $("#level").html('Nivel '+nivel);


  $('#modal-show').modal('hide');
  if(nivel > 1){
    $('#anterior').prop("disabled", false);
    if (nivel == ultimoNivel) {
      $('#siguiente').prop("disabled", true);
    }
  }
  if(nivel < ultimoNivel){
    $('#siguiente').prop("disabled", false);
  }
  if (nivel == 1){
    $('#anterior').prop("disabled", true);
  }

});

//OBTENER DATOS DEL USUARIO DESDE DATATABLE
$('#redDetalles-table tbody' ).on('click','#getData', function () {
  var id              = $(this).attr('data-id');
  var campodeBusqueda = 'id_users';
  $.ajax({
      url  : "/busquedaUsuarioSimple",
      type :"POST",
      data :{ sponsor : sponsorPadre, campodeBusqueda : campodeBusqueda, campo : id },
      dataType: "json",
      beforeSend: function () {
        },
  }).done( function(d) {
    if(d.flag == true){
      openInfo(d.data);
      // alertify.alert('<div align="center">¡Excelente!</div>', '<div align="center">\t\t '+d.mensaje+' </div>',
      // function(){  openInfo(d.data);  });
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

});

//OBTENER DATOS DEL USUARIO DESDE LA BUSQUEDA
$("#searchButton").unbind('click');
$("#searchButton").click(function() {
  var campo           = $("#campo").val();
  var campodeBusqueda = $("#campo_busqueda").val();
  if (campo && campodeBusqueda){
    $.ajax({
      url  : "/busquedaUsuarioSimple",
      type :"POST",
      data :{ sponsor : sponsorPadre, campodeBusqueda : campodeBusqueda, campo : campo },
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
