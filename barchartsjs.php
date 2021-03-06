<?php 
// ambil query
require_once 'query.php'

?>



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

      <!-- <style type="text/css">
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
      </style> -->
   <body>

      <div class="container">

        <a href="barprovinsi.php"><h2>Data Indonesia</h2></a>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pilih Provinsi
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <input class="form-control" id="myInput" type="text" placeholder="Pilih Provinsi..">
            <li><a href="barchartsjs.php">Aceh</a></li>
            <li><a href="sumaterautara.php">Sumatera Utara</a></li>
            <li><a href="#">Riau</a></li>
            <li><a href="#">Sumatera Barat</a></li>
            <li><a href="#">Sumatera Selatan</a></li>
            <li><a href="#">Jambi</a></li>
          </ul>
        </div>

      </div>



      <!-- tampilkan chart -->
      <div id = "container" style = "width: 1200px; height: 500px; margin: 0 auto"></div>
      <!-- link kembali kehalaman index -->
      <div style="margin-left: 120px">
        <div><a href="barprovinsi.php">Back</a></div>
      </div>


      <script language = "JavaScript">

         $(document).ready(function() {
          // const rand = function (from, to) {
          //   return Math.round(from + Math.random() * (to - from));
          // };

            // tipe chart  
            var chart = {
               type: 'column',
            };

            // menampilkan range selector di grafik 
            var rangeSelector= {
              enabled: true,
              floating: false,
              selected: 1,
              inputPosition: {
                align: 'right',
                x: -170,
                y: 0
              },

              // setting button zoom
              buttons: [
                {
                    // id: '1w',
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
            };

            // fitur zoom dengan scroll mouse
            var mapNavigation= {
              enableMouseWheelZoom: true
            };
            
            // judul
            var title = {
               text: 'Provinsi Aceh'   
            };

            var subtitle = {
               text: 'Scroll to Zoom'  
            };

            // sumbu x
            var xAxis = {
               // ambil data tanggal untuk mengisi xAxis
               // categories: [<?php while ($p = mysqli_fetch_array($kategori)) { echo '"' . $p['te'] . '",';}?>],
               type: 'datetime',
               minRange: 1
            };

            // sumbu y
            var yAxis = {
               title: {
                  text: 'Density index',
                  align: 'middle'
               }
            };

            var tooltip = {
               // keterangan kursor saat mengarah ke grafik
              valueSuffix: ' (Density Index)'
            };

            // membuat legend
            var legend = {
               title: {
                  text: 'City District : '
               },
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };

            // option pada legend
            var plotOptions = {
               column: {
                  // menampilkan label masing2 kabkot pada column chart
                  dataLabels: {
                     enabled: true
                  },
               },
               // stacking column pada grafik
               series: {
                  stacking: 'normal',
                  groupZPadding: 10,
                  depth: 60,
                  groupPadding: 0,
                  grouping: false,
                  pointStart: Date.UTC(2020,4,4),
                  pointInterval: 24*3600*1000
               }
            };

            // data grafik
            var series =  
            [
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

            ];

            var json = {};
            json.rangeSelector = rangeSelector;   
            json.chart = chart;
            json.mapNavigation = mapNavigation; 
            json.title = title;   
            json.subtitle = subtitle; 
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.series = series;
            json.plotOptions = plotOptions;
            json.legend = legend;
            $('#container').highcharts(json);

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
