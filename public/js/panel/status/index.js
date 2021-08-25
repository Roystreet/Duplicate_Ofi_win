$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table1;
var table2;
var table3;

$(document).ready(function() {

  table1 = $('#statusReds-table').DataTable({
            'ajax': {
              'url': "/getStatusRed",
              'type':"POST",
            },
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

            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/estatus-red/'+data+'"      class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a>'+
                '<a href="/estatus-red/'+data+'/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a>'+
                '</div>';
              }},
              {data:"descripcion",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"status",
             "render": function (data, type, row) {
                return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="fa fa-check-circle"></i><a>' :
                '<a onclick="estatusUploadRed('+row.id+')"><i class="fa fa-ban-circle"></i><a>';
            }},
          ],
        });

  table2 = $('#statusSessions-table').DataTable({
                  'ajax': {
                    'url': "/getStatusSession",
                    'type':"POST",
                  },
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

                  'columns'       : [
                    {data:"id",
                    "render": function (data, type, row) {
                      return '<div class="btn-group">'+
                      '<a href="/estatus-sesion/'+data+'"      class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a>'+
                      '<a href="/estatus-sesion/'+data+'/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a>'+
                      '</div>';
                    }},
                    {data:"status_session",
                    "render": function (data, type, row) {
                     return (data) ? data : '-';
                    }},
                    {data:"status",
                   "render": function (data, type, row) {
                      return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="fa fa-check-circle"></i><a>' :
                      '<a onclick="estatusUploadSessions('+row.id+')"><i class="fa fa-ban-circle"></i><a>';
                  }},
                ],
              });

  table3 = $('#statusUsersApps-table').DataTable({
                              'ajax': {
                                'url': "/getStatusUsersApp",
                                'type':"POST",
                              },
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

                              'columns'       : [
                                {data:"id",
                                "render": function (data, type, row) {
                                  return '<div class="btn-group">'+
                                  '<a href="/estatus-usuarios-app/'+data+'"      class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a>'+
                                  '<a href="/estatus-usuarios-app/'+data+'/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a>'+
                                  '</div>';
                                }},
                                {data:"status_users_app",
                                "render": function (data, type, row) {
                                 return (data) ? data : '-';
                                }},
                                {data:"status",
                               "render": function (data, type, row) {
                                  return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="fa fa-check-circle"></i><a>' :
                                  '<a onclick="estatusUploadUsersApps('+row.id+')"><i class="fa fa-ban-circle"></i><a>';
                              }},
                            ],
                          });


  });

  function estatusUploadRed(id) {

    $.ajax({
      url: "/updateStatusStatusRed", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
      }).done( function(d) {
        if(d.object == 'success'){
          table1.ajax.reload();
        }
      }).fail  ( function() { alert("Ha ocurrido un error en la operación");
      }).always( function() {       });
  }

  function estatusUploadSessions(id) {

    $.ajax({
      url: "/updateStatusStatusSession", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
      }).done( function(d) {
        if(d.object == 'success'){
          table2.ajax.reload();
        }
      }).fail  ( function() { alert("Ha ocurrido un error en la operación");
      }).always( function() {       });
  }

  function estatusUploadUsersApps(id) {

    $.ajax({
      url: "/updateStatusStatusUsersApp", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
      }).done( function(d) {
        if(d.object == 'success'){
          table3.ajax.reload();
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
