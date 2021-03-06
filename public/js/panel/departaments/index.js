$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {

  table = $('#departaments-table').DataTable({
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
            }
          });

});

$("#search"  ).click(function() {
    var formulario = $("#formIndexDepartamet").serializeObject();

    table = $('#departaments-table').removeAttr('width').DataTable({
            'ajax': {
              'url': "/getDepartament",
              'type':"POST",
              'data' :{ formulario : formulario }
            },
            'responsive'    : false,
            'destroy'       : true,
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
                '<a href="/departamento/'+data+'"      class="btn btn-outline-blue btn-sm"><i class="fa fa-eye"></i></a>'+
                '<a href="/departamento/'+data+'/edit" class="btn btn-outline-blue btn-sm"><i class="fa fa-edit"></i></a>'+
                '</div>';
              }},
              {data:"id_country",
              "render": function (data, type, row) {
               return (data) ? row.get_country.country : '-';
              }},
              {data:"departament",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"status",
             "render": function (data, type, row) {
                return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="fa fa-check-circle"></i><a>' :
                '<a onclick="estatusUpload('+row.id+')"><i class="fa fa-ban-circle"></i><a>';
            }},
          ],
        });
  });

$("#clean"  ).click(function() {
//de acuerdo a los campos q quiero limpiar
  $('#id_country'  ).val('').trigger('change');
  $('#id_departament').val('').trigger('change');

});

function estatusUpload(id) {

  $.ajax({
    url: "/updateStatusDepartament", //ESTO VARIA
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
