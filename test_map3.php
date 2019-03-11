<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

      var data = google.visualization.arrayToDataTable([
        ['State', 'Popularity'],
        ['ID-JK', 10],
        ['ID-JB', 2],
        ['ID-BA', 3],
        ['ID-PA', 4],
        ['ID-YO', 5],
        ['ID-KB', 10]
      ]);

      var options = {
        displayMode: 'regions',
        resolution:'provinces',
        colorAxis:{
          colors:['red','green'],
          minValue: 0,
          maxValue:10},
       region:'ID',
       legend:'none'
      };

      var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

     chart.draw(data, options);
  }
</script>
  </head>
  <body>
    <div id="regions_div" style="width: 100%; height: 100%;"></div>
  </body>
</html>