<?php
require('finally.php');
include('include/header.php');

if ($_POST['graph_rest'] == 'dist'):
?>
<script type="text/javascript">
function drawVisualization() {
    var dataS = google.visualization.arrayToDataTable([
               ['Task', 'Occurrences'],
               <?php echo countForPieChartDist(cleanArray('student', $data), $_POST['time_start'], $_POST['time_end']); ?>
               ]);
    var dataI = google.visualization.arrayToDataTable([
               ['Task', 'Occurrences'],
               <?php echo countForPieChartDist(cleanArray('instructor', $data), $_POST['time_start'], $_POST['time_end']); ?>
               ]);
    var dataE = google.visualization.arrayToDataTable([
               ['Task', 'Occurrences'],
               <?php echo countEngForPieChartDist(cleanArray('Eng', $data), $_POST['time_start'], $_POST['time_end']); ?>
               ]);
    new google.visualization.<?php echo $_POST['graph_type']; ?>(document.getElementById('graphStudent')).draw(dataS, null);
    new google.visualization.<?php echo $_POST['graph_type']; ?>(document.getElementById('graphInstructor')).draw(dataI, null);
    new google.visualization.<?php echo $_POST['graph_type']; ?>(document.getElementById('graphEngagement')).draw(dataE, null);
}
google.setOnLoadCallback(drawVisualization);
</script>
<?php
endif;
?>
<div id="graphContainer">
    <div class="graph">
        <h1>Student</h1> <a id="graphStudentLink" href="#" onclick="convertGraphToImage('#graphStudent', '#graphStudentLink');">Download Image</a>
        <div id="graphStudent" class="graphContainer"></div>
    </div>
    <div class="graph">
        <h1>Instructor</h1> <a id="graphInstructorLink" href="#" onclick="convertGraphToImage('#graphInstructor', '#graphInstructorLink');">Download Image</a>
        <div id="graphInstructor" class="graphContainer"></div>
    </div>
    <div class="graph">
        <h1>Engagement</h1> <a id="graphEngagementLink" href="#" onclick="convertGraphToImage('#graphEngagement', '#graphEngagementLink');">Download Image</a>
        <div id="graphEngagement" class="graphContainer"></div>
    </div>
</div>
<script type="text/javascript" src="include/canvg/canvg.js"></script>
<script type="text/javascript" src="include/canvg/rgbcolor.js"></script>
<script type="text/javascript" src="include/canvg/StackBlur.js"></script>
<script type="text/javascript">
function convertGraphToImage(element, output) {
    var svg = $(element).find('svg').parent().html();
    var doc = document;
    var canvas = doc.createElement('canvas');
    canvas.setAttribute('style', 'position: absolute; ' + '');
    doc.body.appendChild(canvas);
    canvg(canvas, svg);
    var imgData = canvas.toDataURL("image/png");
    canvas.parentNode.removeChild(canvas);
    $(output).attr('href', imgData);
    return imgData;
}
</script>
<?php include('include/legend.php'); ?>
<img src="img/door_out.png" /> <a href="view.php?id=<?php echo $_GET['id']; ?>">Go Back</a>
<?php include('include/footer.php'); ?>