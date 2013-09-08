<?php
require('finally.php');
require('include/header.php');
$time = '';

for ($i = 0; $i <= ($data['time'] + 2); $i += 2) { 
    $time .= '<option value="' . $i . '">' . $i . '</option>' . "\n";
}
$outOfClass = array();
$outOfClass[] = isset($data['class_ooc_homework']) ? 'Homework' : '';
$outOfClass[] = isset($data['class_ooc_prereading']) ? 'Pre-Readings' : '';
$outOfClass[] = isset($data['class_ooc_labs']) ? 'Labs' : '';
$outOfClass[] = isset($data['class_ooc_projects']) ? 'Projects' : '';
$outOfClass = array_filter($outOfClass);
?>
<div class="viewPageNoPrint">
<b><?php echo $data['class_name']; ?></b> as instructed by 
<b><?php echo $data['instructor_name']; ?></b> on 
<b><?php echo $date; ?></b><br /><br />
Observer: <?php echo $data['observer_name']; ?><br /><br />

<div class="viewPageLane"><img src="img/add.png" /> <a href="new-session.php">New Session</a></div>
<div class="viewPageLane"><img src="img/door_out.png" /> <a href="welcome.php"">Go Home</a></div>
<div class="viewPageLane"><img src="img/printer.png" /> <a onclick="window.print();">Print Data</a></div>
<div class="viewPageLane"><img src="img/page_excel.png" /> <a href="excel.php?id=<?php echo $_GET['id']; ?>">Export Data to Excel</a></div>
<div class="viewPageLane"><img src="img/chart_pie.png" /> <a onclick="$('#graphManager').toggle();">Graph Manager</a></div>

<div id="graphManager">
<form id="lbl" method="post" action="graph.php?id=<?php echo $_GET['id']; ?>">

<select name="graph_type">
<option value="PieChart">Pie Chart</option>
</select> of

<select name="graph_rest">
<option value="dist">Distribution of Events</option>
</select> between 

<select name="time_start">
<?php echo $time; ?>
</select> min and

<select name="time_end">
<?php echo $time; ?>
</select> min.<br /><br />

<input class="noMargin" type="submit" value="Graph" />
</form>
</div>
</div>
<div class="viewPageToPrint">
<h1>Classroom Dynamics Observation Protocol (CDOP), ver 7 (as of 19 May 2013)</h1>
This protocol was adapted from: Hora, M., & Ferrare, J.. (2009). Structured observation protocol for instruction
in Institutions of Higher Education (IHEs). Madison, WI: University of Wisconsin-Madison, Wisconsin Center for Education Research.
<br /><br /><br />
<table>
<tr>
<td>
<b>Observer</b>
<blockquote>
<div id="lbl"><label>Name:</label><?php echo $data['observer_name']; ?></div>
<div id="lbl"><label>Location in Class:</label><?php echo $data['observer_location']; ?></div>
</blockquote>
</td>
<td>
<b>Class</b>
<blockquote>
<div id="lbl"><label>Name, Number, Section:</label><?php echo $data['class_name']; ?></div>
<div id="lbl"><label>Instructor Name:</label><?php echo $data['instructor_name']; ?></div>
<div id="lbl"><label>Instructor Department:</label><?php echo $data['instructor_department']; ?></div>
</blockquote>
</td>
</tr>
</table>
<br /><br />
<table id="mainTable" border="1">
<?php for ($i = 0; $i < (($data['time'] + 2) / 2); $i++): ?>
    <?php if ($i % 10 == 0): ?>
        <tr>
        <td class="copyheader" rowspan="2">0. Min</td>
        <td class="copyheader" colspan="13">1. Students Doing</td>
        <td class="copyheader" colspan="12">2. Instructor Doing</td>
        <td class="copyheader" rowspan="2">3. Eng</td>
        <td class="copyheader" rowspan="2">4. Comments</td>
        </tr>
        <tr>
        <?php foreach ($tableElements as $elementName => $elementDesc): ?>
            <td><?php echo str_replace(array('student_', 'instructor_'), '', $elementName); ?></td>
        <?php endforeach; ?>
        </tr>
    <?php endif; ?>
    <tr class="row_to_clone">
    <td><?php echo ($i * 2) . "-" . (($i * 2) + 2); ?> min</td>

    <?php foreach ($tableElements as $elementName => $elementDesc): ?>
        <td class="tableFieldTaken"><?php echo isset($data['table_' . $elementName][$i]) ? '<img class="tableFieldTaken" src="img/blackpixel.jpg" />' : ''; ?></td>
    <?php endforeach; ?>
    <td><?php echo isset($data['table_Eng'][$i]) ? $data['table_Eng'][$i] : ''; ?></td>

    <td><?php echo isset($data['table_Comments'][$i]) ? $data['table_Comments'][$i] : ''; ?></td>
    </tr>
<?php endfor; ?>
</table>
<b>Room Information</b>
<blockquote>
<div id="lbl"><label>Room Layout:</label><?php echo $data['room_layout']; ?></div>
</blockquote><br />
<b>Class</b>
<blockquote>
<div id="lbl"><label>Approximate # Students Present (iClicker):</label><?php echo $data['class_numstudentspresent']; ?></div>
<div id="lbl"><label>Unusual Notes About Class:</label><?php echo $data['class_unusual']; ?></div>
<div id="lbl"><label>How Varied is the Whole Course?:</label><?php echo $data['class_wholebalance']; ?> Active Students/Instructor Delivery</div>
<div id="lbl"><label>How Varied is this Class?:</label><?php echo $data['class_thisbalance']; ?> Active Students/Instructor Delivery</div><br />
<b>What Goes on Out of Class?</b><br />
<?php echo implode(", ", $outOfClass); ?>
</blockquote><br />
<b>Class Narrative (field notes)</b>
<blockquote>
<?php echo $data['narrative']; ?>
</blockquote>
</div>
<?php include('include/footer.php'); ?>