 <?php 
// ambil query
require_once 'query.php'

?>

<html>
   <head>
      <title>Visualization</title>

      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

      <script src="https://code.highcharts.com/stock/highstock.js"></script>
      <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
      <script src="http://code.highcharts.com/maps/modules/map.js"></script>


      <style type="text/css">
        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
      </style>
    </head>
   
   <body>
      <!-- tampilkan grafik -->
      <div id = "container" style = "width: 1200px; height: 500px; margin: 0 auto"></div>

      <div style="margin-left: 120px"><a href="index.php">Back</a></div>

      <script language = "JavaScript">
         $(document).ready(function() {

             // menampilkan range selector di grafik 
             var rangeSelector= {
              // allBut .dateFormat(null, e.min) +
                //             ' | e.max: ' + Highcharts.dateFormat(null, e.max) + ' | e.trigger: ' + e.trigger);

              // setting nilai input tanggal yang ada di range selector
              // events: {           
              //   inputonchange : function () {
              //     var inputValue = input.value,
              //         value = (options.inputDateParser || Date.parse)(inputValue),
              //         xAxis = chart.xAxis[0],
              //         dataMin = xAxis.dataMin,
              //         dataMax = xAxis.dataMax
              //   }
              // },

              enabled: true,
              selected: 2,
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

            // set judul grafik
            var title = {
               text: 'Data All Sumatera'   
            };

            var subtitle = {
               text: ''
            };


            var xAxis = 
            [
              {
                // ambil data tanggal untuk mengisi xAxis
                // categories: [<?php while ($p = mysqli_fetch_array($kategori)) { echo '"' . $p['te'] . '",';}?>],
                type: 'datetime',
                minRange: 1
              },


              // {
              //   events: {
              //     afterSetExtremes: function() {
              //       var series = this.categories[0],
              //         points = series.points,
              //         dataMin = points[0].x,
              //         dataMax = points[points.length - 1].x;
              //       console.log(dataMin, dataMax)
              //     }
              //   }
              // }

              // {
              //   min: new Date('2020/05/04').getTime(),
              //   max: new Date('2020/05/27').getTime(),
              // }


            ];


            var yAxis = {
               // set title yAxis
               title: {
                  text: 'Density Index'
               }
               // plotLines: [{
               //    value: 0,
               //    width: 1,
               //    color: '#808080'
               // }]
            };


            var tooltip = {
               // keterangan tooltip
               valueSuffix: ' (Density Index)',
               // formatter: function() {

               //          return '<b>'+ this.series.name +'</b><br/>'+

               //          this.x +': '+ this.y +'';

               //  }
            };

            // setting legend
            var legend = {
               title: {
                  text: 'City District : '
               },
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };

            var mapNavigation= {
              enableMouseWheelZoom: true
            };

            // setting options pada legend
            var plotOptions= {
              line: {
                dataLabels: {
                     enabled: true
                  },
                
                // setting fungsi item click pada legend  
                events: {
                    legendItemClick: function () {
                    //     chart.yAxis[0].addPlotLine({
                    //     value : 7.5,
                    //     color : 'green',
                    //     dashStyle : 'shortdash',
                    //     width : 2,
                    //     label : {
                    //         text : ''
                    //     }
                    // });
                    
                     if (!this.visible)
                       return true;

                    
                    var seriesIndex = this.index;
                    var series = this.chart.series;
                    
                    for (var i = 0; i < series.length; i++)
                    {
                      if (series[i].index != seriesIndex)
                      {
                        if (series[i].index == seriesIndex && series[i].show())
                        { 
                          series[i].hide()
                        }
                      }
                    }
                     return true;
                    }
                },
                showInLegend: true
              },

              series: {
                pointStart: Date.UTC(2020,4,4),
                pointInterval: 24*3600*1000
              }
            };

            // setting data yang akan di tampilkan pada grafik
            var series =  
            [
              {
                name: 'Aceh Barat Daya',
                data: 
                  [                    
                    <?php while($d=mysqli_fetch_array($acehbaratdaya))
                    {
                      // menampung data density_index kedalam array
                      $arrayacehbaratdaya[] = $d['density_index'];
                    }
                    //menampilkan data array
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
              },

              // {
              //   tooltip: {
              //     valueDecimals: 2
              //   }
              // },

            ];

            var json = {};
            json.rangeSelector = rangeSelector;  
            json.mapNavigation = mapNavigation;          
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.plotOptions = plotOptions;
            json.series = series;

            $('#container').highcharts(json);

         });

      </script>
   </body>
   
</html>