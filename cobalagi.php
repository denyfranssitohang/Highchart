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

 
   <body>

      <div class="container">
        <a href="barprovinsi.php"><h2>Data Indonesia</h2></a>
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
      <div id = "container" style = "width: 1200px; height: 500px; margin: 0 auto"></div>
      <!-- link kembali kehalaman index -->
      <div style="margin-left: 120px">
        <div><a href="barprovinsi.php">Back</a></div>
      </div>


      <script language = "JavaScript">

         $(document).ready(function() {

            // tipe chart  
            var chart = {
               type: 'column',
            };

            // fitur zoom dengan scroll mouse
            var mapNavigation= {
              enableMouseWheelZoom: true
            };
            
            // judul
            var title = {
               text: 'Provinsi Sumatera Utara'   
            };

            var subtitle = {
               text: 'Scroll to Zoom'  
            };

            // sumbu x
            var xAxis = {
               // ambil data tanggal untuk mengisi xAxis
               categories: [<?php while ($p = mysqli_fetch_array($kategori)) { echo '"' . $p['te'] . '",';}?>],
               
            };

            // sumbu y
            var yAxis = {
               min: 0,
               title: {
                  text: 'Density index',
                  align: 'middle'
               },
               // labels: {
               //    overflow: 'justify'
               // },

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

            //   var  zAxis= {
            //   min: 0,
            //   max: 3,
            //   categories: [<?php while ($p = mysqli_fetch_array($kategori)) { echo '"' . $p['te'] . '",';}?>],
            //   labels: {
            //     y: 5,
            //     rotation: 18
            //   }
            // };

            var tooltip = {
               // keterangan kursor saat mengarah ke grafik
               headerFormat: '<b>{point.x}</b><br/>',
               pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
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
               }
            };

            // var credits = {
            //    enabled: false
            // };

            // data grafik
            var series =  
            [
              // {
              //   findNearestPointBy: 'xy'
              // },

              {
                name: 'Asahan',
                data: 
                  [
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $asahan = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='ASAHAN'");
                    
                    while($d=mysqli_fetch_array($asahan))
                    {
                      $arrayasahan[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arrayasahan, ','); ?>
                  ]
              },

              {
                name: 'Batu Bara',
                data: 
                [
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $batubara = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='BATU BARA'");
                    
                    while($d=mysqli_fetch_array($batubara))
                    {
                      $arraybatubara[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arraybatubara, ','); ?>
                  ]
              },

              {
                name: 'Dairi',
                data: 
                [
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $dairi = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='DAIRI'");
                    
                    while($d=mysqli_fetch_array($dairi))
                    {
                      $arraydairi[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arraydairi, ','); ?>
                  ]
              },

              {
                name: 'Deli Serdang',
                data: 
                [
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $deliserdang = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='DELI SERDANG'");
                    
                    while($d=mysqli_fetch_array($deliserdang))
                    {
                      $arraydeliserdang[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arraydeliserdang, ','); ?>
                  ]
              },

              {
                name: 'Aceh Selatan',
                data: 
                [
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $humbanghasudutan = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='HUMBANG HASUNDUTAN'");
                    
                    while($d=mysqli_fetch_array($humbanghasudutan))
                    {
                      $arrayhumbanghasudutan[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arrayhumbanghasudutan, ','); ?>
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
                    // menampung data density_index kedalam array
                    <?php 
                    // query
                    $karo = mysqli_query($koneksi, "SELECT * FROM all_data_sumatera_new WHERE kd_a='KARO'");
                    
                    while($d=mysqli_fetch_array($karo))
                    {
                      $arraykaro[] = $d['density_index'];
                    }
                    //menampilkan data arra
                    echo join($arraykaro, ','); ?>
                  ]
              },

              // {
              //   name: 'Aceh Tengah',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($acehtengah))
              //     {
              //       $arrayacehtengah[] = $d['density_index'];
              //     }
              //      echo join($arrayacehtengah, ',');?>
              //   ]
              // },

              // {
              //   name: 'Aceh Tenggara',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($acehtenggara))
              //     {
              //       $arrayacehtenggara[] = $d['density_index'];
              //     }
              //      echo join($arrayacehtenggara, ',');?>
              //   ]
              // },

              // {
              //   name: 'Aceh Tenggara',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($acehtenggara))
              //     {
              //       $arrayacehtenggara[] = $d['density_index'];
              //     }
              //      echo join($arrayacehtenggara, ',');?>
              //   ]
              // },

              // {
              //   name: 'Aceh Timur',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($acehtimur))
              //     {
              //       $arrayacehtimur[] = $d['density_index'];
              //     }
              //      echo join($arrayacehtimur, ',');?>
              //   ]
              // },

              // {
              //   name: 'Aceh Utara',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($acehutara))
              //     {
              //       $arrayacehutara[] = $d['density_index'];
              //     }
              //      echo join($arrayacehutara, ',');?>
              //   ]
              // },

              // {
              //   name: 'Bener Meriah',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($benermeriah))
              //     {
              //       $arraybenermeriah[] = $d['density_index'];
              //     }
              //      echo join($arraybenermeriah, ',');?>
              //   ]
              // },

              // {
              //   name: 'Bireuen',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($bireuen))
              //     {
              //       $arraybireuen[] = $d['density_index'];
              //     }
              //      echo join($arraybireuen, ',');?>
              //   ]
              // },

              // {
              //   name: 'Gayo Lues',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($gayolues))
              //     {
              //       $arraygayolues[] = $d['density_index'];
              //     }
              //      echo join($arraygayolues, ',');?>
              //   ]
              // },

              // {
              //   name: 'Kota Banda Aceh',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($kotabandaaceh))
              //     {
              //       $arraykotabandaaceh[] = $d['density_index'];
              //     }
              //      echo join($arraykotabandaaceh, ',');?>
              //   ]
              // },

              // {
              //   name: 'Kota Langsa',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($kotalangsa))
              //     {
              //       $arraykotalangsa[] = $d['density_index'];
              //     }
              //      echo join($arraykotalangsa, ',');?>
              //   ]
              // },

              // {
              //   name: 'Kota Lhokseumawe',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($kotalhokseumawe))
              //     {
              //       $arraykotalhokseumawe[] = $d['density_index'];
              //     }
              //      echo join($arraykotalhokseumawe, ',');?>
              //   ]
              // },

              // {
              //   name: 'Kota Sabang',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($kotasabang))
              //     {
              //       $arraykotasabang[] = $d['density_index'];
              //     }
              //      echo join($arraykotasabang, ',');?>
              //   ]
              // },

              // {
              //   name: 'Kota Subulussalam',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($kotasubulussalam))
              //     {
              //       $arraykotasubulussalam[] = $d['density_index'];
              //     }
              //      echo join($arraykotasubulussalam, ',');?>
              //   ]
              // },

              // {
              //   name: 'Nagan Raya',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($naganraya))
              //     {
              //       $arraynaganraya[] = $d['density_index'];
              //     }
              //      echo join($arraynaganraya, ',');?>
              //   ]
              // },

              // {
              //   name: 'Pidie Jaya',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($pidiejaya))
              //     {
              //       $arraypidiejaya[] = $d['density_index'];
              //     }
              //      echo join($arraypidiejaya, ',');?>
              //   ]
              // },

              // {
              //   name: 'Pidie',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($pidie))
              //     {
              //       $arraypidie[] = $d['density_index'];
              //     }
              //      echo join($arraypidie, ',');?>
              //   ]
              // },

              // {
              //   name: 'Simeulue',
              //   data: 
              //   [
              //     <?php while($d=mysqli_fetch_array($simeulue))
              //     {
              //       $arraysimeulue[] = $d['density_index'];
              //     }
              //      echo join($arraysimeulue, ',');?>
              //   ]
              // }

            ];

            var json = {};   
            json.chart = chart;
            json.mapNavigation = mapNavigation; 
            json.title = title;   
            json.subtitle = subtitle; 
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            // json.zAxis = zAxis;  
            json.series = series;
            json.plotOptions = plotOptions;
            json.legend = legend;
            // json.credits = credits;
            $('#container').highcharts(json);

            // // Add mouse events for rotation
            // $(chart.container).on('mousedown.hc touchstart.hc', function(eStart) {
            //   eStart = chart.pointer.normalize(eStart);

            //   var posX = eStart.pageX,
            //     posY = eStart.pageY,
            //     alpha = chart.options.chart.options3d.alpha,
            //     beta = chart.options.chart.options3d.beta,
            //     newAlpha,
            //     newBeta,
            //     sensitivity = 5; // lower is more sensitive

            //   $(document).on({
            //     'mousemove.hc touchdrag.hc': function(e) {
            //       // Run beta
            //       newBeta = beta + (posX - e.pageX) / sensitivity;
            //       chart.options.chart.options3d.beta = newBeta;

            //       // Run alpha
            //       newAlpha = alpha + (e.pageY - posY) / sensitivity;
            //       chart.options.chart.options3d.alpha = newAlpha;

            //       chart.redraw(false);
            //     },
            //     'mouseup touchend': function() {
            //       $(document).off('.hc');
            //     }
            //   });
            // });

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
