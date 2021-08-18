$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {


  table = $('#sessions-table').DataTable({
              'ajax': {
              'url': "/getSession",
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
                '<a href="/sesiones/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
                '<a href="/sesiones/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
                '</div>';
              }},
              {data:"token",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"d_inicio",
              "render": function (data, type, row) {

                var today = new Date(row.d_inicio);
                  var dd = today.getDate();
                  var mm = today.getMonth()+1; //January is 0!
                  var yyyy = today.getFullYear();
                  if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
                  var today = dd+'/'+mm+'/'+yyyy;
                  return today;

              }},
              {data:"h_inicio",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"d_fin",
              "render": function (data, type, row) {
                var d = new Date(row.d_fin);
                var data = d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear();
                return data;
              }},
              {data:"h_fin",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"ip",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"navegador",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"id_status_session",
              "render": function (data, type, row) {
               return (data) ? row.get_status_session.status_session : '-';
              }},
            ],
          });



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
