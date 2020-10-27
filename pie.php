<?php 

require_once 'query.php'

?>

<html>
   <head>
      <title>Highcharts Tutorial</title>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   </head>
   
   <body>
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
         $(document).ready(function() {
            var chart = {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false
            };
            var title = {
               text: 'Browser market shares at a specific website, 2014'   
            };      
            var tooltip = {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            };
            var plotOptions = {
               pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  
                  dataLabels: {
                     enabled: false           
                  },
                  
                  showInLegend: true
               }
            };
            var series = [{
               type: 'pie',
               name: 'Browser share',
               data: 
               [
                  [
                    'Aceh Barat Daya',
                    <?php while($d=mysqli_fetch_array($acehbaratdaya))
                    {
                      $arrayacehbaratdaya[] = $d['density_index'];

                    }
                    int($arrayacehbaratdaya);                    
                    echo count($arrayacehbaratdaya); ?>
                  ],

                  [
                  'Aceh Barat',
                    <?php while($d=mysqli_fetch_array($acehbarat))
                    {
                      $arrayacehbarat[] = $d['density_index'];
                      
                    }
                     int($arrayacehbarat);
                     echo count($arrayacehbarat);?>
                  ]
                ]
            }];     
            var json = {};   
            json.chart = chart; 
            json.title = title;     
            json.tooltip = tooltip;  
            json.series = series;
            json.plotOptions = plotOptions;
            $('#container').highcharts(json);  
         });
      </script>
   </body>
   
</html>