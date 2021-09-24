$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {

  table = $('#redUsuarios-table').DataTable({
            'ajax': {
              'url': "/getRedUsuarios",
              'type':"POST",
            },
           'responsive'  : false,
           'autoWidth'   : true,
           'destroy'     : true,
           'deferRender' : true,
            'scrollX'    : true,
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

            'columns'       : [
              {data:"data.id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/red-usuarios/'+data+'"      class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a>'+
                '<a href="/red-usuarios/'+data+'/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a>'+
                '</div>';
              }},
              {data:"data.codigo_invitado",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"data.usuario_invitado",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"data.id_users",
              "render": function (data, type, row) {
                return (data) ?
                (row.get_users_invitado.first_name)?
                row.get_users_invitado.first_name : '-'
                : '-';
              }},
              {data:"data.id_users",
              "render": function (data, type, row) {
                return (data) ?
                (row.get_users_invitado.last_name)?
                row.get_users_invitado.last_name : '-'
                : '-';
              }},

              {data:"data.id_users",
              "render": function (data, type, row) {
                return (data) ?
                (row.get_users_invitado.email)?
                row.get_users_invitado.email : '-'
                : '-';
              }},

              {data:"data.id_users_sponsor",
              "render": function (data, type, row) {
                return (data) ?
                (row.get_users_sponsor_codigo.usuario_invitado)?
                row.get_users_sponsor_codigo.usuario_invitado : '-'
                : '-';
              }},

              {data:"data.id_users_sponsor",
              "render": function (data, type, row) {
                return (data) ?
                (row.get_users_sponsor_codigo.codigo_invitado)?
                row.get_users_sponsor_codigo.codigo_invitado : '-'
                : '-';
              }},

              {data:"data.id_status_red",
              "render": function (data, type, row) {
               return (data) ? row.get_status_red.descripcion : '-';
              }},
              {data:"data.status",
             "render": function (data, type, row) {
                return (data == true)? '<a onclick="estatusUpload('+row.id+')" class="btn btn-outline-green btn-sm"><i class="fa fa-check-circle"></i><a>' :
                '<a onclick="estatusUpload('+row.id+')" class="btn btn-outline-red  btn-sm"><i class="fa fa-close-circle"></i><a>';
            }},
          ],
        });

  });

  function estatusUpload(id) {

    $.ajax({
      url: "/updateStatusRedUsuarios", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
      }).done( function(d) {
        if(d.object == 'success'){
          table.ajax.reload();
        }
      }).fail  ( function() { alert("Ha ocurrido un error en la operación");
      }).always( function() {       });
  }
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
