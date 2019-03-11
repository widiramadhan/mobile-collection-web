<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
       
<div id="regions_div" style="width: 100%;height:100%;"></div>

<script>
google.charts.load('upcoming', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Provinces', 'Popularity'],
          [{v: 'ID-JK', f: 'Jakarta'}, 200],
          [{v: 'ID-JB', f: 'Jawa Barat'}, 300],
		  [{v: 'ID-BA', f: 'Bali'}, 300],
		  [{v: 'ID-PA', f: 'Papua'}, 300],
		  [{v: 'ID-YO', f: 'Yogyakarta'}, 300],
		  [{v: 'ID-SA', f: 'Sulawesi Utara'}, 300],
		  [{v: 'ID-LA', f: 'Lampung'}, 300],
		  [{v: 'ID-KB', f: 'Kalimantan Barat'}, 300]
        ]);

        var options = {
          region:'ID',
          resolution:'provinces',
          colorAxis: {
            minValue: 0,
            maxValue: 400
          }
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
</script>