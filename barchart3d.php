<!-- <?php 
// query
require_once 'query.php'

?> -->



<html>
   <head>
      <title>Bar Chart</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

      <script src="https://code.highcharts.com/stock/highstock.js"></script>
      <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
      <script src="http://code.highcharts.com/maps/modules/map.js"></script>


      <style type="text/css">
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
      </style>
   
   <body>
          <!-- tampilkan chart -->
       <div id="container" style="width: 1200px; height: 500px; margin: 0 auto"></div>
          <!-- link kembali kehalaman index -->
       <div style="margin-left: 120px"><a href="index.php">Back</a></div>


      <script language = "JavaScript">
     
      $(function() {
        // const rand = function (from, to) {
        //   return Math.round(from + Math.random() * (to - from));
        // };
        var chart = Highcharts.chart('container', {
          chart: {
            // tipe chart 
            type: 'column',

            // grafik 3d 
            // options3d: {
            //   enabled: true,
            //   alpha: 15,
            //   beta: 15,
            //   viewDistance: 25,
            //   depth: 40,
            //   frame: {
            //     bottom: {
            //       size: 1,
            //       color: 'rgba(0,0,0,0.05)'
            //     }
            //   }
            // }
          },

          rangeSelector: {
            enabled: true,
            selected: 1,
            inputPosition: {
              align: 'right',
              x: -170,
              y: 0
            },
           
            buttons: [
                {
                    id: '1w',
                    type: 'week',
                    count: 1,
                    text: '1w'
                }, 
                {
                    type: 'week',
                    count: 2,
                    text: '2w'
                }, 
                {
                    type: 'week',
                    count: 3,
                    text: '3w'
                }, 
                {
                    id: 'all',
                    type: 'all',
                    text: 'All'
              }
            ]  
          },
            // fitur zoom dengan scroll mouse
          mapNavigation: {
            enableMouseWheelZoom: true
          },
          // judul
          title: {
            text: 'Data All Sumatera (3d)'
          },
          //sub judul
          subtitle: {
            text: 'Scroll to zoom'
          },

          // sumbu y
          yAxis: {
            title: {
              text: 'Density index',
              align: 'middle',
            }
          },

          // sumbu x
          xAxis: {
            // categories: [<?php while ($p = mysqli_fetch_array($kategori)) { echo '"' . $p['te'] . '",';}?>],
            type: 'datetime'
          },

          // setting scroll zoom
          mapNavigation: {
            enableMouseWheelZoom: true
          },

          // membuat legend
          legend: {
           title: {
              text: 'City District : '
           },
           layout: 'vertical',
           align: 'right',
           verticalAlign: 'middle',
           borderWidth: 0
          },

          tooltip: {
            valueSuffix: '(Density index)'
          },

          // options pada legend
          plotOptions: {
            column: {
              // menampilkan label masing2 kabkot pada column chart
              dataLabels: {
                 enabled: true
              }
            },
           // stacking dan grouping data column pada grafik
            series: {
              stacking: 'normal',
              groupZPadding: 10,
              depth: 60,
              groupPadding: 0,
              grouping: false,
              pointStart: Date.UTC(2020,4,4),
              pointInterval: 24*3600*1000
            }
          },

          //data grafik
          series: [
            {
              name: 'Aceh Barat Daya',
              data: 
                [
                  // menampung data density_index kedalam array
                  <?php while($d=mysqli_fetch_array($acehbaratdaya))
                  {
                    $arrayacehbaratdaya[] = $d['density_index'];
                  }
                  //menampilkan data arra
                  echo join($arrayacehbaratdaya, ','); ?>
                ]
            },

            {
              name: 'Aceh Barat',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehbarat))
                {
                  $arrayacehbarat[] = $d['density_index'];
                }
                 echo join($arrayacehbarat, ',');?>
              ]
            },

            {
              name: 'Aceh Besar',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehbesar))
                {
                  $arrayacehbesar[] = $d['density_index'];
                }
                 echo join($arrayacehbesar, ',');?>
              ]
            },

            {
              name: 'Aceh Jaya',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehjaya))
                {
                  $arrayacehjaya[] = $d['density_index'];
                }
                 echo join($arrayacehjaya, ',');?>
              ]
            },

            {
              name: 'Aceh Selatan',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehselatan))
                {
                  $arrayacehselatan[] = $d['density_index'];
                }
                 echo join($arrayacehselatan, ',');?>
              ]
            },

            // {
            //   name: 'Aceh Singkil',
            //   data: 
            //   [
            //     <?php while($d=mysqli_fetch_array($acehsingkil))
            //     {
            //       $arrayacehsingkil[] = $d['density_index'];
            //     }
            //      echo join($arrayacehsingkil, ',');?>
            //   ]
            // },

            {
              name: 'Aceh Tamiang',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehtamiang))
                {
                  $arrayacehtamiang[] = $d['density_index'];
                }
                 echo join($arrayacehtamiang, ',');?>
              ]
            },

            {
              name: 'Aceh Tengah',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehtengah))
                {
                  $arrayacehtengah[] = $d['density_index'];
                }
                 echo join($arrayacehtengah, ',');?>
              ]
            },

            {
              name: 'Aceh Tenggara',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehtenggara))
                {
                  $arrayacehtenggara[] = $d['density_index'];
                }
                 echo join($arrayacehtenggara, ',');?>
              ]
            },

            {
              name: 'Aceh Tenggara',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehtenggara))
                {
                  $arrayacehtenggara[] = $d['density_index'];
                }
                 echo join($arrayacehtenggara, ',');?>
              ]
            },

            {
              name: 'Aceh Timur',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehtimur))
                {
                  $arrayacehtimur[] = $d['density_index'];
                }
                 echo join($arrayacehtimur, ',');?>
              ]
            },

            {
              name: 'Aceh Utara',
              data: 
              [
                <?php while($d=mysqli_fetch_array($acehutara))
                {
                  $arrayacehutara[] = $d['density_index'];
                }
                 echo join($arrayacehutara, ',');?>
              ]
            },

            {
              name: 'Bener Meriah',
              data: 
              [
                <?php while($d=mysqli_fetch_array($benermeriah))
                {
                  $arraybenermeriah[] = $d['density_index'];
                }
                 echo join($arraybenermeriah, ',');?>
              ]
            },

            {
              name: 'Bireuen',
              data: 
              [
                <?php while($d=mysqli_fetch_array($bireuen))
                {
                  $arraybireuen[] = $d['density_index'];
                }
                 echo join($arraybireuen, ',');?>
              ]
            },

            {
              name: 'Gayo Lues',
              data: 
              [
                <?php while($d=mysqli_fetch_array($gayolues))
                {
                  $arraygayolues[] = $d['density_index'];
                }
                 echo join($arraygayolues, ',');?>
              ]
            },

            {
              name: 'Kota Banda Aceh',
              data: 
              [
                <?php while($d=mysqli_fetch_array($kotabandaaceh))
                {
                  $arraykotabandaaceh[] = $d['density_index'];
                }
                 echo join($arraykotabandaaceh, ',');?>
              ]
            },

            {
              name: 'Kota Langsa',
              data: 
              [
                <?php while($d=mysqli_fetch_array($kotalangsa))
                {
                  $arraykotalangsa[] = $d['density_index'];
                }
                 echo join($arraykotalangsa, ',');?>
              ]
            },

            {
              name: 'Kota Lhokseumawe',
              data: 
              [
                <?php while($d=mysqli_fetch_array($kotalhokseumawe))
                {
                  $arraykotalhokseumawe[] = $d['density_index'];
                }
                 echo join($arraykotalhokseumawe, ',');?>
              ]
            },

            {
              name: 'Kota Sabang',
              data: 
              [
                <?php while($d=mysqli_fetch_array($kotasabang))
                {
                  $arraykotasabang[] = $d['density_index'];
                }
                 echo join($arraykotasabang, ',');?>
              ]
            },

            {
              name: 'Kota Subulussalam',
              data: 
              [
                <?php while($d=mysqli_fetch_array($kotasubulussalam))
                {
                  $arraykotasubulussalam[] = $d['density_index'];
                }
                 echo join($arraykotasubulussalam, ',');?>
              ]
            },

            {
              name: 'Nagan Raya',
              data: 
              [
                <?php while($d=mysqli_fetch_array($naganraya))
                {
                  $arraynaganraya[] = $d['density_index'];
                }
                 echo join($arraynaganraya, ',');?>
              ]
            },

            {
              name: 'Pidie Jaya',
              data: 
              [
                <?php while($d=mysqli_fetch_array($pidiejaya))
                {
                  $arraypidiejaya[] = $d['density_index'];
                }
                 echo join($arraypidiejaya, ',');?>
              ]
            },

            {
              name: 'Pidie',
              data: 
              [
                <?php while($d=mysqli_fetch_array($pidie))
                {
                  $arraypidie[] = $d['density_index'];
                }
                 echo join($arraypidie, ',');?>
              ]
            },

            {
              name: 'Simeulue',
              data: 
              [
                <?php while($d=mysqli_fetch_array($simeulue))
                {
                  $arraysimeulue[] = $d['density_index'];
                }
                 echo join($arraysimeulue, ',');?>
              ]
            }
          ],
          function(chart) {

            // apply the date pickers
            setTimeout(function() {
                $('input.highcharts-range-selector', $('#' + chart.options.chart.renderTo)).datepicker()
            }, 0)
          }
        });
        
        // Set the datepicker's date format
        $.datepicker.setDefaults({
            dateFormat: 'yy-dd-mm',
            onSelect: function(dateText) {
                this.onchange();
                this.onblur();
            }
        });

      });

      </script>

      <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".dropdown-menu li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
      </script>
   </body>
   
</html>
