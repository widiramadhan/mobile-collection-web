<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="regions_div" style="width: 900px; height: 500px;"></div>

<script>
google.charts.load('current', {
'packages':['geochart'],
// Note: you will need to get a mapsApiKey for your project.
// See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
var data = google.visualization.arrayToDataTable([
  ['Country', 'Popularity'],
  ['Indonesia', 200],
  ['United States', 1000],
  ['Brazil', 400],
  ['Canada', 500],
  ['France', 600],
  ['RU', 700]
]);

var options = {};

var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

chart.draw(data, options);
}
</script>