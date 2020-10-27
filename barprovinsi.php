<?php 
// ambil query
require_once 'query.php'

?>



<html>
   <head>
       <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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

      <title>Bar Chart</title>
 
   <body>

    <!-- button dropdown -->
    <div class="container">
      <h2>Data All Indonesia</h2>
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pilih Provinsi
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <input class="form-control" id="myInput" type="text" placeholder="Search..">
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
    <div id = "indonesia" style = "width: 1200px; height: 500px; margin: 0 auto"></div>
     <!-- link kembali kehalaman index -->
    <div style="margin-left: 120px"><a href="index.php">Back</a></div>



      <script>
        $(document).ready(function() {

            // tipe chart  
            var chart = {
               type: 'column'
            };

             // menampilkan range selector di grafik 
            var rangeSelector= {
              enabled: true,
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
               text: 'Data All Indonesia'
            };

            var subtitle = {
               text: ''  
            };

            // sumbu x
            var xAxis = {
               // ambil data tanggal untuk mengisi xAxis
               // <?php $tanggal      = mysqli_query($koneksi, "SELECT DISTINCT te FROM dataprovinsi"); ?>
               // categories: [<?php while ($p = mysqli_fetch_array($tanggal)) { echo '"' . $p['te'] . '",';}?>],
               type: 'datetime',
               // events: {
               //  setExtremes: function(e) {
               //    $('#report').html('<b>Set extremes:</b> e.min: '+ Highcharts.dateFormat(null, e.min) +
               //      ' | e.max: '+ Highcharts.dateFormat(null, e.max) + ' | e.trigger: ' + e.trigger);
               //  }
               // },
               // ordinal: false,
               minRange: 1
            };

            // var xAxis = {
            //   ordinal: false
            // }

            // sumbu y
            var yAxis = {
               min: 0,
               title: {
                  text: 'Total Density index',
                  align: 'middle'
               },
               labels: {
                  overflow: 'justify'
               },

               // stackLabels: {
               //    enabled: false,
               //    style: {
               //       fontWeight: 'bold',
               //       color: ( // theme
               //         Highcharts.defaultOptions.title.style &&
               //         Highcharts.defaultOptions.title.style.color
               //       ) || 'gray'
               //    }
               // }
            };

            var tooltip = {
               // keterangan kursor saat mengarah ke grafik
               valueSuffix: ' (Density Index)'
               // headerFormat: '<b>{point.x}</b><br/>',
               // pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            };

            // membuat legend
            var legend = {
               title: {
                  text: 'Provinsi : '
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
                  // marker: {
                  //   enabled: true
                  // }
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
                name: 'Aceh',
                data: 
                  [
                    // query
                    <?php $aceh = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'ACEH' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($aceh))
                    {
                      $arrayaceh[] = $d['jumlah'] ;
                    }
                    //menampilkan data arra
                    echo join($arrayaceh, ','); ?>
                  ]
              },

              {
                name: 'Sumatera Barat',
                data: 
                  [
                    // query
                    <?php $sumbar = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'SUMATERA BARAT' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($sumbar))
                    {
                      $arraysumbar[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arraysumbar, ','); ?>
                  ]
              },

              {
                name: 'Sumatera Utara',
                data: 
                  [
                    // query
                    <?php $sumut = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'SUMATERA UTARA' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($sumut))
                    {
                      $arraysumut[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arraysumut, ','); ?>
                  ]
              },

              {
                name: 'Kepulauan Bangka Belitung',
                data: 
                  [
                    // query
                    <?php $bangkabelitung = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'KEPULAUAN BANGKA BELITUNG' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($bangkabelitung))
                    {
                      $arraybangkabelitung[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arraybangkabelitung, ','); ?>
                  ]
              },

              {
                name: 'Sumatera Selatan',
                data: 
                  [
                    // query
                    <?php $sumsel = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'SUMATERA SELATAN' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($sumsel))
                    {
                      $arraysumsel[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arraysumsel, ','); ?>
                  ]
              },

              {
                name: 'Jambi',
                data: 
                  [
                    // query
                    <?php $jambi = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'JAMBI' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($jambi))
                    {
                      $arrayjambi[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arrayjambi, ','); ?>
                  ]
              },

              {
                name: 'Riau',
                data: 
                  [
                    // query
                    <?php $riau = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'RIAU' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($riau))
                    {
                      $arrayriau[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arrayriau, ','); ?>
                  ]
              },

              {
                name: 'Bengkulu',
                data: 
                  [
                    // query
                    <?php $bengkulu = mysqli_query($koneksi, "SELECT te, SUM(density_index) AS jumlah FROM dataprovinsi WHERE provinsi = 'BENGKULU' GROUP BY te");  ?>

                    // menampung data density_index kedalam array
                    <?php while($d=mysqli_fetch_array($bengkulu))
                    {
                      $arraybengkulu[] = $d['jumlah'];
                    }
                    //menampilkan data arra
                    echo join($arraybengkulu, ','); ?>
                  ]
              }

            ];


          var json = {};   
            json.chart = chart;
            json.rangeSelector = rangeSelector;
            json.mapNavigation = mapNavigation; 
            json.title = title;   
            json.subtitle = subtitle; 
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.series = series;
            json.plotOptions = plotOptions;
            json.legend = legend;
            $('#indonesia').highcharts(json);

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
