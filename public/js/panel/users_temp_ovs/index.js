$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table;

// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#usersTempOvs-table').DataTable({
        'responsive': false,
        'destroy': true,
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
        "order": [
            [0, 'desc']
        ]
    });
});


$("#search").click(function() {
    var formulario = $("#formIndexUserApps").serializeObject();

    table = $('#usersTempOvs-table').removeAttr('width').DataTable({
        'ajax': {
            'url': "/getUsersTempOvs",
            'type': "POST",
            'data': {
                formulario: formulario
            }
        },
        'responsive': false,
        'destroy': true,
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
        'columns': [{
                'data': "id",
                "render": function(data, type, row) {
                    return '<div class="btn-group">' +
                        '<a id="getData" data-id="' + row.id + '" class="btn btn-outline-blue  btn-sm"><i class="fas fa-eye"></i></a>' +
                        '</div>';
                }
            },
            {
                data: "first_name",
                "render": function(data, type, row) {
                    return (data) ? data : '-';
                }
            },
            {
                data: "last_name",
                "render": function(data, type, row) {
                    return (data) ? data : '-';
                }
            },
            {
                data: "email",
                "render": function(data, type, row) {
                    return (data) ? data : '-';
                }
            },
            {
                data: "phone",
                "render": function(data, type, row) {
                    var number = (data) ? data : '-';
                    if (number.length > 10 || number.length < 10 && row.get_country.id != 1) {
                        number = number;
                    } else if (row.get_country.id == 1) {
                        var numtemp = (number.length == 9) ? number : number.substr(number.length - 9, number.length);
                        number = '+' + row.get_country.code_phone + numtemp;
                    } else {
                        number = '+' + row.get_country.code_phone + number;
                    }
                    return '<a target="_blank" href=https://wa.me/' + number + '>Contactar</a>';
                }
            },
            {
                data: "id_country",
                "render": function(data, type, row) {
                    return (data) ? row.get_country.country : '-';
                }
            },
            {
                data: "status_ov",
                "render": function(data, type, row) {

                    return '<div class="btn-group">' +
                        '<a id="changeStatus" data-id="' + row.id + '" class="btn btn-outline-blue  btn-sm"> ' + data + '</a>' +
                        '</div>';
                }
            },
            {
                data: "id_user_modify",
                "render": function(data, type, row) {
                  return (data) ? row.get_user_modify.last_name : '-';
                }
            },
        ],
    });
});


$("#clean").click(function() {
    $('#name').val('');
    $('#email').val('');
    $('#telefono').val('');
    $('#id_country').val('').trigger('change');
});


$('#usersTempOvs-table tbody').on('click', '#getData', function() {
    var id = $(this).attr('data-id');

    var campodeBusqueda = 'id_users';
    $.ajax({
        url: "/getUsersTempOvsId/" + id,
        type: "GET",
        dataType: "json",
        beforeSend: function() {},
    }).done(function(d) {
        if (d.flag == true) {
            openInfo(d.data);
        } else {
            alertify.alert('<div align="center">¡Aviso!</div>', '<div align="center">\t\t ' + d.mensaje + ' </div>',
                function() {
                    //clean
                });
        }

    }).fail(function() {
        alert("¡Ha ocurrido un error en la operación!"); //alerta del ticket no resgistrado
    }).always(function() {});

});

$('#usersTempOvs-table tbody').on('click', '#changeStatus', function() {
    var id = $(this).attr('data-id');
    $("#id_users_temp_ovs").val(id);
    $('#modal-show-status').modal('show');
});

$("#saveStatus").click(function() {
    var id_users_temp_ovs = $("#id_users_temp_ovs").val();
    var status_ov = $("#status_ov").val();
    console.log(id_users_temp_ovs);
    console.log(status_ov);


    $.ajax({
        url: "/updateStatusTempOvs",
        type: "POST",
        data: {
            id_users_temp_ovs: id_users_temp_ovs,
            status_ov: status_ov
        },
        dataType: "json",
        beforeSend: function() {},
    }).done(function(d) {
      table.ajax.reload();
    }).fail(function() {
        alert("¡Ha ocurrido un error en la operación!"); //alerta del ticket no resgistrado
    }).always(function() {});
});


//OBTENIENDO Data
function openInfo(usuario) {
    $(".nombres_html").html(usuario.first_name);
    $(".apellidos_html").html(usuario.last_name);
    $(".documento_html").html(usuario.get_tp_document_identies.abbreviation + ' - ' + usuario.n_document);
    $(".email_html").html(usuario.email);
    $(".telefono_html").html(usuario.phone);
    $(".pais_html").html(usuario.get_country.country);
    $(".creado_html").html(usuario.created_at);
    $('#modal-show').modal('show');

}


//GET ARRAY FORM
$.fn.serializeObject = function() {
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
