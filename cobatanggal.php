<html>
   <head>
      <title>Visualization</title>

      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

      <script src="https://code.highcharts.com/stock/highstock.js"></script>
      <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

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
              // setting nilai input tanggal yang ada di range selector
              events: {           
                inputonchange : function () {
                  var inputValue = input.value,
                      value = (options.inputDateParser || Date.parse)(inputValue),
                      xAxis = chart.xAxis[0],
                      dataMin = xAxis.dataMin,
                      dataMax = xAxis.dataMax;
                }
              },


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
                    id: '1w',
                    type: 'week',
                    count: 7,
                    text: '1w'
                }, 
                {
                    type: 'week',
                    count: 14,
                    text: '2w'
                }, 
                {
                    type: 'week',
                    count: 21,
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
               text: 'Title Coba'   
            };

            var subtitle = {
               text: 'Subtitle'
            };


            var xAxis = 
            [
              {
                // ambil data tanggal untuk mengisi xAxis
               // categories: ['04 Mei','05 Mei','06 Mei','07 Mei','08 Mei','09 Mei','10 Mei','11 Mei','12 Mei','13 Mei','14 Mei','15 Mei','16 Mei','17 Mei'],
			   type: 'datetime'
              }

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
			
			// setting data yang akan di tampilkan pada grafik
            var series =  
            [
              {
                name: 'Jayapura',
                data: 
                  [                    
                    12,45,67,44,55,67,89,34,67,77,88,65,67,35
                  ],
          				pointStart: Date.UTC(2020, 4, 4),
          				pointInterval: 3600 * 1000 * 24
              },

              {
                name: 'Aceh',
                data: 
                [
                  98,54,76,44,51,32,74,52,85,90,81,60,62,76
                ],
          				pointStart: Date.UTC(2020, 4, 4),
          				pointInterval: 3600 * 1000 * 24
              }

              // {
              //   tooltip: {
              //     valueDecimals: 2
              //   }
              // },

              // function (chart) {
              // // apply the date pickers
              //   setTimeout(function () {
              //       $('input.highcharts-range-selector', $(chart.container).parent())
              //           .datepicker()
              //   }, 0)
              // }

            ];


            var tooltip = {
               // keterangan tooltip
               valueSuffix: ' (Density Index)'
               // formatter: function() {

               //          return '<b>'+ this.series.name +'</b><br/>'+

               //          this.x +': '+ this.y +'';

               //  }
            }

            // setting legend
            var legend = {
               title: {
                  text: 'City : '
               },
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
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
              }
            };

            var json = {};
            json.rangeSelector = rangeSelector;            
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.plotOptions = plotOptions;
            json.series = series;

            // $.datepicker.setDefaults({
            //   dateFormat: 'yy-mm-dd',
            //   onSelect: function () {
            //     this.onchange();
            //     this.onblur();
            //     }
            // });

            $('#container').highcharts(json);

            // $('#all').click(function() {
            //     //chart.xAxis[0].setCategories(['Jan', 'Feb','Mar']);
            //     chart.xAxis[0].setExtremes(0,26)
            // });

            // $('#1w').click(function() {
            //     //chart.xAxis[0].setCategories(['Jan', 'Feb']);
            //     chart.xAxis[0].setExtremes(0,6)
            // });

         });

      </script>
   </body>
   
</html>