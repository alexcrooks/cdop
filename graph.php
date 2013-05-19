<?php
require("finally.php");
include("include/header.php");

if ($_POST['graph_rest'] == "dist") {
?>
<script type="text/javascript">
function drawVisualization() {
    var data = google.visualization.arrayToDataTable([
               ['Task', 'Occurrences'],
               <?php echo countForPieChartDist(cleanArray($data), $_POST['time_start'], $_POST['time_end']); ?>
               ]);
    new google.visualization.<?php echo $_POST['graph_type']; ?>(document.getElementById('visualization')).
        draw(data, null);
}
google.setOnLoadCallback(drawVisualization);
</script>
<?php
}
?>
<div id="visualization" style="width: 600px; height: 400px;"></div>
<?php include("include/legend.php"); ?>
<img src="img/door_out.png" /> <a href="view.php?id=<?php echo $_GET['id']; ?>">Go Back</a>
<?php include("include/footer.php"); ?>