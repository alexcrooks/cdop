<?php
require("finally.php");
include("include/header.php");
$time = "";

for ($i = 0; $i <= ($data['time'] + 2); $i += 2) { 
    $time .= "<option value=\"".$i."\">".$i."</option>\n";
}
$outOfClass = array();
$instructorUses = array();
$studentUses = array();

$outOfClass[] = isset($data['class_ooc_homework']) ? "Homework" : "";
$outOfClass[] = isset($data['class_ooc_prereading']) ? "Pre-Readings" : "";
$outOfClass[] = isset($data['class_ooc_labs']) ? "Labs" : "";
$outOfClass[] = isset($data['class_ooc_projects']) ? "Projects" : "";
$outOfClass = array_filter($outOfClass);

$instructorUses[] = isset($data['iu_powerpoint']) ? "Powerpoint" : "";
$instructorUses[] = isset($data['iu_tablet']) ? "Tablet" : "";
$instructorUses[] = isset($data['iu_projector']) ? "Projector" : "";
$instructorUses[] = isset($data['iu_iclicker']) ? "iClicker" : "";
$instructorUses[] = isset($data['iu_whiteboard']) ? "Whiteboard" : "";
$instructorUses[] = isset($data['iu_microphone']) ? "Microphone" : "";
$instructorUses[] = isset($data['iu_ta']) ? "TA" : "";
$instructorUses[] = isset($data['iu_other']) && $data['su_other'] != "Other" ? "Other" : "";
$instructorUses = array_filter($instructorUses);

$studentUses[] = isset($data['su_nothing']) ? "Nothing" : "";
$studentUses[] = isset($data['su_papernotes']) ? "Paper Notes" : "";
$studentUses[] = isset($data['su_givennotes']) ? "Given Notes" : "";
$studentUses[] = isset($data['su_laptop']) ? "Laptop" : "";
$studentUses[] = isset($data['su_distractor']) ? "Distractor" : "";
$studentUses[] = isset($data['su_other']) && $data['su_other'] != "Other" ? "Other" : "";
$studentUses = array_filter($studentUses);
?>
<div class="viewPageNoPrint">
<b><?php echo $data['class_name']; ?></b> as instructed by 
<b><?php echo $data['instructor_name']; ?></b> on 
<b><?php echo $date; ?></b><br /><br />
Observer: <?php echo $data['observer_name']; ?> (<?php echo $data['observer_institution']; ?>)<br /><br />
<div class="viewPageLane"><img src="img/add.png" /> <a href="index.php">New Session</a></div>
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
<div id="lbl"><label>Institution:</label><?php echo $data['observer_institution']; ?></div>
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
<?php
for ($i = 0; $i < (($data['time'] + 2) / 2); $i++) { 
    if ($i % 10 == 0) { 
?>
<tr>
<td class="copyheader" rowspan="2">0. Min</td>
<td class="copyheader" colspan="13">1. Students Doing</td>
<td class="copyheader" colspan="12">2. Instructor Doing</td>
<td class="copyheader" rowspan="2">3. Eng</td>
<td class="copyheader" rowspan="2">4. Comments</td>
</tr>
<tr>
<td>L</td>
<td>Ind</td>
<td>CG</td>
<td>WG</td>
<td>OG</td>
<td>AnQ</td>
<td>SQ</td>
<td>WC</td>
<td>Prd</td>
<td>SP</td>
<td>TQ</td>
<td>W</td>
<td>O</td>

<td>Lec</td>
<td>RtW</td>
<td>FUp</td>
<td>PQ</td>
<td>CQ</td>
<td>AnQ</td>
<td>MG</td>
<td>1o1</td>
<td>D/V</td>
<td>AD</td>
<td>W</td>
<td>O</td>
</tr>
<?php
    }
?>
<tr class="row_to_clone">
<td><?php echo ($i*2)."-".(($i*2)+2); ?> min</td>

<td><?php echo isset($data['table_L'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_Ind'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_CG'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_WG'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_OG'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_AnQS'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_SQ'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_WC'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_Prd'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_SP'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_TQ'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_W'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_SO'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>

<td><?php echo isset($data['table_Lec'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_RtW'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_FUp'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_PQ'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_CQ'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_AnQI'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_MG'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_1o1'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_DV'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_AD'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_N'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>
<td><?php echo isset($data['table_IO'][$i]) ? "<img class=\"tableFieldTaken\" src=\"img/blackpixel.jpg\" />" : ""; ?></td>

<td><?php echo isset($data['table_Eng'][$i]) ? $data['table_Eng'][$i] : ""; ?></td>

<td><?php echo isset($data['table_Comments'][$i]) ? $data['table_Comments'][$i] : ""; ?></td>
</tr>
<?php
}
?>
</table>
<b>Room Information</b>
<blockquote>
<div id="lbl"><label>Room Layout:</label><?php echo $data['room_layout']; ?></div>
</blockquote><br />
<b>Class</b>
<blockquote>
<div id="lbl"><label># Students Enrolled:</label><?php echo $data['class_numstudentsenrolled']; ?></div>
<div id="lbl"><label># Students Present (iClicker):</label><?php echo $data['class_numstudentspresent']; ?></div>
<div id="lbl"><label>Unusual Notes About Class:</label><?php echo $data['class_unusual']; ?></div>
<div id="lbl"><label>How Varied is the Whole Course?:</label><?php echo $data['class_wholebalance']; ?> Active Students/Instructor Delivery</div>
<div id="lbl"><label>How Varied is this Class?:</label><?php echo $data['class_thisbalance']; ?> Active Students/Instructor Delivery</div><br />
<b>What Goes on Out of Class?</b><br />
<?php echo implode(", ", $outOfClass); ?>
</blockquote><br />
<b>What is Used by the Instructor?</b>
<blockquote>
<?php echo implode(", ", $instructorUses); ?><br />
<div id="lbl"><label>Comments:</label><?php echo $data['iu_comments'] == "Comments" ? "" : $data['iu_comments']; ?></div>
</blockquote><br />
<b>What is Used By Students?</b>
<blockquote>
<?php echo implode(", ", $studentUses); ?><br />
<div id="lbl"><label>Comments:</label><?php echo $data['su_comments'] == "Comments" ? "" : $data['su_comments']; ?></div>
</blockquote><br />
<b>Class Narrative (field notes)</b>
<blockquote>
<?php echo $data['narrative']; ?>
</blockquote>
</div>
<?php include("include/footer.php"); ?>