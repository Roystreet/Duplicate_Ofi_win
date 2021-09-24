$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#agents-table').DataTable({
      'responsive'    : false,
      'destroy'       : true,
      'language': {
         "decimal": "",
         "emptyTable": "No hay registros para mostrar",
         "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "infoEmpty": "Mostrando 0 to 0 of 0 registros",
         "infoFiltered": "(Filtrado de _MAX_ total registros)",
         "infoPostFix": "",
         "thousands": ",",
         "lengthMenu": "Mostrar _MENU_ registros",
         "loadingRecords": "Cargando...",
         "processing": "Procesando...",
         "search": "Buscar:",
         "zeroRecords": "Sin resultados encontrados",
         "paginate": {
             "first": "Primero",
             "last": "Último",
             "next": "Siguiente",
             "previous": "Anterior"
         }
       },
    });
});

$(document).ready(function() {
    $('#dataTableActivity').DataTable({
        "order": [[ 0, 'desc' ]]
    });
});


$("#search"  ).click(function() {
    var formulario = $("#formIndexAgents").serializeObject();

    table = $('#agents-table').removeAttr('width').DataTable({
            'ajax': {
              'url': "/getAgents",
              'type':"POST",
              'data' :{ formulario : formulario }
            },
            'responsive'    : false,
            'destroy'       : true,
            'language': {
               "decimal": "",
               "emptyTable": "No hay registros para mostrar",
               "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
               "infoEmpty": "Mostrando 0 to 0 of 0 registros",
               "infoFiltered": "(Filtrado de _MAX_ total registros)",
               "infoPostFix": "",
               "thousands": ",",
               "lengthMenu": "Mostrar _MENU_ registros",
               "loadingRecords": "Cargando...",
               "processing": "Procesando...",
               "search": "Buscar:",
               "zeroRecords": "Sin resultados encontrados",
               "paginate": {
                   "first": "Primero",
                   "last": "Último",
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
             },
            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/agentes/'+data+'"      class="btn btn-outline-blue  btn-sm"><i class="fas fa-eye"></i></a>'+
                '<a href="/agentes/'+data+'/edit" class="btn btn-outline-blue  btn-sm"><i class="fas fa-edit"></i></a>'+
                '</div>';
              }},
              {data:"first_name",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"last_name",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"email",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"id_tp_sexo",
              "render": function (data, type, row) {
               return (data) ? row.get_sexo.descripcion : '-';
              }},
              {data:"phone",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"id_country",
              "render": function (data, type, row) {
               return (data) ? row.get_country.country : '-';
              }},
              {data:"id_status_users_app",
              "render": function (data, type, row) {
               return (data) ? row.get_status_users_app.status_users_app : '-';
              }},
              {data:"id_status_users_app",
              "render": function (data, type, row) {
                 return (data == 3)? '<a onclick="bloqueoAcceso('+row.id+', \'desbloquear\')" class="btn btn-outline-red btn-sm"><i class="fa fa-lock"></i><a>' :
                 '<a onclick="bloqueoAcceso('+row.id+',\'bloquear\')" class="btn btn-outline-green  btn-sm"><i class="fas fa-unlock"></i><a>';
              }},

            ],
          });
});


function bloqueoAcceso(id, accion) {
  alertify.confirm('<div align="center">¡Aviso!</div>', '<div align="center">\t\t ¿Confirmas que deseas '+accion+' este usuario?</div>',
  function(){

    $.ajax({
      url: "/updateBloqueoAcceso", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
    }).done( function(d) {
      if(d.object == 'success'){
        table.ajax.reload();
      }
    }).fail  ( function() { alert("No se logró actualizar el estado del usuario, por favor contacte con el administrador. (Error: UPJSAPPUser)");
  }).always( function() {       });


  }
  , function(){}).set('labels', {ok:'Continuar', cancel:'Cancelar'});


}

$("#clean"  ).click(function() {
  //de acuerdo a los campos q quiero limpiar
  $('#id_users_app'       ).val('').trigger('change');
  $('#id_country'         ).val('').trigger('change');
  $('#id_status_users_app').val('').trigger('change');
  $('#email'              ).val('');
  $('#telefono'           ).val('');
});

//GET ARRAY FORM
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
