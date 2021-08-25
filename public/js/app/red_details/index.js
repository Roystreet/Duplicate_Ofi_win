$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $('.loader-container').show(300);


$('#usuarios').DataTable({
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
    "bProcessing": true,
    'responsive': true,
    ajax: {

        url: '/red-informacion',
        type: 'POST',
        'beforeSend': function(request) {
            $('.loader-container').show(300);
        },
    },

    columns: [{
            'data': 'level',
            "render": function(data, type, row) {
                return (data) ? data : '-' ;
            }
        },
        {
            'data': "username",
            "render": function(data, type, row) {
                return (data) ? data : '-' ;
            }
        },
        {
            'data': "first_name",
            "render": function(data, type, row) {
                return (data) ? data : '-';
            }
        },
        {
            'data': "last_name",
            "render": function(data, type, row) {
                return (data) ? data : '-' ;
            }
        },
        {
            'data': "public_email",
            "render": function(data, type, row) {
                return (data) ? data : '-' ;
            }
        },
        {
            'data': "phone_number",
            "render": function(data, type, row) {
                return (data) ? data : '-' ;
            }
        },


        {
            'data': "status_red",
            "render": function(data, type, row) {
                return (data) ?  data : '-';
            }
        },

        {
            'data': "id",
            "render": function(data, type, row) {
                return '<a id="getData" data-id="' + row.id + '" data-sponsor_id="' + row.sponsor_id + '"><i class="fa fa-eye"><i></a>';
            }
        },

    ],
    "order": [
        [0, "asc"]
    ],
    "initComplete": function(settings, json) {
        $('.loader-container').hide(300);
        var matriz = {};
        json.fecha.forEach(function(registro) {
            var date_register = registro["created_at"];
            matriz[date_register] = matriz[date_register] ? (matriz[date_register] + 1) : 1;
        });
        var new_array = [];
        var stop = 0;
        for (let variable in matriz) {
            // console.log(`obj.${prop} = ${obj[prop]}`);

            new_array.push({
                created_at: variable,
                no: matriz[variable]
            });

        }

        $('#total_all').html(numeral(json.cantidad).format(formato.numero));
        $('#niveles').html(numeral(json.niveles).format(formato.numero));
        $('#total_semana').html(numeral(json.cantidad_semana).format(formato.numero));
        $('#total_mes').html(numeral(json.cantidad_mes).format(formato.numero));
        var data_fecha = [];
        // new_array = new_array.sort((a, b) => a.created_at - b.created_at);
        new_array.forEach(element => {
            var parts = element.created_at.split(' ');
            var parts2 = parts[0].split('-');
            var mydate = Date.UTC(parts2[0], parts2[1] - 1, parts2[2]);
            // stop++;
            //     if(stop <= 9)
            data_fecha.push([mydate, element.no]);
        });

        data_fecha.sort((a, b) => a[0] - b[0]);
        Highcharts.setOptions({
            lang: {
                months: [
                    'Ene', 'Feb', 'Mar', 'Abr',
                    'May', 'Jun', 'Jul', 'Ago',
                    'Sep', 'Oct', 'Nov', 'Dic'
                ],
                viewFullscreen: "Ver pantalla completa",

                // weekdays: [
                //     'Dimanche', 'Lundi', 'Mardi', 'Mercredi',
                //     'Jeudi', 'Vendredi', 'Samedi'
                // ]
            }
        });

        //inicio del informacion de tabla estadistica
        Highcharts.chart('container', {

            title: {
                text: 'historial registros tu red'
            },

            // subtitle: {
            //     text: 'Source: thesolarfoundation.com'
            // },

            yAxis: {
                title: {
                    text: 'Cantidad de registrados'
                }
            },

            xAxis: {
                // accessibility: {
                //     rangeDescription: 'Range: 2010 to 2017'
                // },
                labels: {

                    format: '{value:%B-%Y}',
                    // formatter: function () {
                    //     //return Highcharts.dateFormat('%H:%M %p<br>%m-%d %a', this.value);
                    //     return Highcharts.dateFormat('%H:%M<br>%b-%d-%y', this.value);
                    // }
                }
            },

            legend: {
                enabled: false,
                layout: 'vertical',
                align: 'right',
                showInLegend: false,
                verticalAlign: 'middle'
            },
            marker: {
                enabled: true
            },
            tooltip: {
                headerFormat: '{point.x:%d-%B-%Y}<br>',
                pointFormat: "Se registraron {point.y} personas.",
                borderColor: colores.segundario,
                backgroundColor: colores.primario,
                borderWidth: 3,
                style: {
                    color: '#fff',
                    fontWeight: 'bold'
                }

            },


            plotOptions: {
                series: {
                    color: colores.invertido
                }
            },

            series: [{
                name: 'Números de registros',
                data: data_fecha, //[[Date.UTC(2014, 1, 10),43934], [Date.UTC(2015, 2, 10),52503], [Date.UTC(2016, 3, 10),57177]],
                // pointStart: Date.UTC(2013, 0, 1),
            }, ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
        //fin del informacion de tabla estadistica
    }
});


//OBTENER DATOS DEL USUARIO DESDE DATATABLE
$('#usuarios tbody' ).on('click','#getData', function () {
  var id              = $(this).attr('data-id');
  var sponsor_id      = $(this).attr('data-sponsor_id');

  var campodeBusqueda = 'id_users_invitado';
  $.ajax({
      url  : "/busquedaUsuarioSimple",
      type :"POST",
      data :{ sponsor : sponsor_id, campodeBusqueda : campodeBusqueda, campo : id },
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

//OBTENIENDO Data
function openInfo(data){
  var usuario = data.dataUser;
  var sponsor = data.dataRed;
  $(".directosDetails"  ).hide();
  $(".indirectosDetails").hide();

  $(".nombres_html"    ).html(usuario.first_name+' '+usuario.middle_name);
  $(".apellidos_html"  ).html(usuario.last_name);
  $(".rol_html"        ).html(usuario.tp_rol);
  $(".usuario_invitado_html").html(sponsor.usuario_invitado);
  $(".codigo_invitado_html" ).html(sponsor.codigo_invitado);


  if(data.nivel == 1){
    $(".directosDetails").show();
    $(".email_html"      ).html(usuario.email);
    $(".telefono_html"   ).html(usuario.phone);
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
