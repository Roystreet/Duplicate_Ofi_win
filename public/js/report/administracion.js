$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var usuario;
function buscar(){
    $.ajax({
        url  : "/usuario/buscar",
        type :"POST",
        data :{
        username : $('#username').val(),
      },
        dataType: "json",
        beforeSend: function () {
          $('.loader-container').show(300);
          },
    }).done( function(a){
      $('.loader-container').hide(300);
      if(a.object == "success"){
        getData(a.data.username);
        usuario = a.data;
      }else{
        alert(a.message);
      }
    }).fail( function() {
      alert("¡Ha ocurrido un error en la operación!");
    }).always( function() {
    });
}


function getData(usuario){
    // console.log(usuario);
    $.ajax({
        url  : "/usuario/red/informacion",
        type :"POST",
        data :{
            username : usuario
      },
        dataType: "json",
        beforeSend: function () {
          $('.loader-container').show(300);
          },
    }).done( function(json) {

        usuario = json.data[0];
        console.log(usuario);
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

          new_array.push({created_at:variable,no:matriz[variable]});

        }

      $('#total_user').html(numeral(json.cantidad).format(formato.numero));
      $('#niveles').html(numeral(json.niveles).format(formato.numero));
    //   $('#total_semana').html(numeral(json.cantidad_semana).format(formato.numero));
    //   $('#total_mes').html(numeral(json.cantidad_mes).format(formato.numero));
      var data_fecha = [];
      // new_array = new_array.sort((a, b) => a.created_at - b.created_at);
      new_array.forEach(element => {
          var parts =element.created_at.split(' ');
          var parts2 =parts[0].split('-');
      var mydate =  Date.UTC(parts2[0], parts2[1] - 1, parts2[2]);
      // stop++;
      //     if(stop <= 9)
      data_fecha.push([mydate,element.no]);
      });

      data_fecha.sort((a, b) => a[0] - b[0]);
      Highcharts.setOptions({
          lang: {
              months: [
                  'Ene', 'Feb', 'Mar', 'Abr',
                  'May', 'Jun', 'Jul', 'Ago',
                  'Sep', 'Oct', 'Nov', 'Dic'
              ],
              viewFullscreen:"Ver pantalla completa",

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
              data:data_fecha, //[[Date.UTC(2014, 1, 10),43934], [Date.UTC(2015, 2, 10),52503], [Date.UTC(2016, 3, 10),57177]],
              // pointStart: Date.UTC(2013, 0, 1),
          },
          ],

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
    //   if(d.object == "success"){

    //   }else{
    //     alert(d.message);
    //   }


    }).fail( function() {
      alert("¡Ha ocurrido un error en la operación!");
    }).always( function() {
    });
}

function descargarExcel(){
    var url = '/administracion/reporte/usuaro/red/'+usuario.username;
    window.open(url, '_blank');
      return false;
}
