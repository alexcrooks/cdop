<?php require('include/header.php'); ?>
<?php require('include/config.php'); ?>
<script type="text/javascript">setInterval(tick, 1000);</script>
<div id="ite">Begin the next time interval now.</div>

<div id="floatingClock">
<div class="clockLabel">Official NIST Time</div>
<div class="splitSmall"></div>
<div id="clocka" class="clock">00:00:00</div>
<div class="split"></div>
<div id="clockb" class="clock">00:00</div>
<div class="splitSmall"></div>
<div class="clockLabel" onclick="stopRows(false); return false;">Stop Watch</div>
</div>
</div>
<h1>Classroom Observation Protocol for Undergraduate STEM - COPUS</h1>
<br /><br /><br />
<form method="post" action="process.php">
<table>
<tr>
<td>
<b>Observer</b>
<blockquote>
<div id="lbl"><label>Name:</label><input type="text" name="observer_name" placeholder="Name" class="text_main" /></div>
<div id="lbl"><label>Location in Class:</label><input type="text" name="observer_location" placeholder="Location in Class" class="text_main" /></div>
</blockquote>
</td>
<td>
<b>Class</b>
<blockquote>
<div id="lbl"><label>Name, Number, Section:</label><input type="text" name="class_name" placeholder="Name, Number, Section" class="text_main" /></div>
<div id="lbl"><label>Instructor Name:</label><input type="text" name="instructor_name" placeholder="Instructor Name"  class="text_main" /></div>
<div id="lbl"><label>Instructor Department:</label><input type="text" name="instructor_department" placeholder="Instructor Department" class="text_main" /></div>
</blockquote>
</td>
</tr>
</table>
<br /><br />
<div id="start" onclick="startRows(); return false;">Click here to start the clock.</div>
<table id="mainTable" border="1">
<tr>
<td class="copyheader" rowspan="2">0. Min</td>
<td class="copyheader" colspan="13">1. Students Doing</td>
<td class="copyheader" colspan="12">2. Instructor Doing</td>
<td class="copyheader" rowspan="2">3. Eng</td>
<td class="copyheader" rowspan="2">4. Comments</td>
</tr>
<tr>
<?php foreach ($tableElements as $elementName => $elementDesc): ?>
<td title="<?php echo $elementDesc; ?>"><?php echo str_replace(array('student_', 'instructor_', 'DV', 'AD'), array('', '', 'D/V', 'Adm'), $elementName); ?></td>
<?php endforeach; ?>
</tr>
<tr class="row_to_clone">
<td>0-2 min</td>


<?php foreach ($tableElements as $elementName => $elementDesc): ?>
    <td title="<?php echo $elementDesc; ?>"><input type="checkbox" value="1" name="table_<?php echo $elementName; ?>[0]" class="checkbox_reg" /></td>
<?php endforeach; ?>

<td><select name="table_Eng[0]" class="select_eng"><option value="">?</option><option value="Low">Low</option><option value="Med">Med</option><option value="High">High</option></select></td>

<td><input type="text" name="table_Comments[0]" class="text_comments" /></td>
</tr>
</table>
<?php include("include/legend.php"); ?>
<b>Room Information</b>
<blockquote>
<div id="lbl"><label>Room Layout:</label><input type="text" name="room_layout" placeholder="Room Layout" class="text_main" /></div>
</blockquote><br />
<b>Class</b>
<blockquote>
<div id="lbl"><label>Approximate # Students Present (iClicker):</label><input type="text" name="class_numstudentspresent" placeholder="# Students Present (iClicker)" class="text_main" /></div>
<div id="lbl"><label>Unusual Notes About Class:</label><input type="text" name="class_unusual" placeholder="Unusual Notes About Class" class="text_main" /></div>
<div id="lbl"><label>How Varied is the Whole Course?:</label>
<select name="class_wholebalance">
<option value="">How Varied is the Whole Course?</option>
<option value="0/100">0% Active Students/100% Instructor Delivery</option>
<option value="20/80">20/80</option>
<option value="40/60">40/60</option>
<option value="60/40">60/40</option>
<option value="80/20">80/20</option>
<option value="100/0">100/0</option>
</select></div>
<div id="lbl"><label>How Varied is this Class?:</label>
<select name="class_thisbalance">
<option value="">How Varied is this Class?</option>
<option value="0/100">0% Active Students/100% Instructor Delivery</option>
<option value="20/80">20/80</option>
<option value="40/60">40/60</option>
<option value="60/40">60/40</option>
<option value="80/20">80/20</option>
<option value="100/0">100/0</option>
</select></div><br />
<b>What Goes on Out of Class?</b><br /><br />
<input type="checkbox" value="1" name="class_ooc_homework" /> Homework
<input type="checkbox" value="1" name="class_ooc_prereading" /> Pre-Readings
<input type="checkbox" value="1" name="class_ooc_labs" /> Labs
<input type="checkbox" value="1" name="class_ooc_projects" /> Projects
</blockquote><br />
<b>Class Narrative (field notes)</b>
<blockquote>
<p class="hideonprint">
Information could include:<br />
&bull; The structure of the lesson (e.g., how the instructor sequenced material, the narrative arc of the class)<br />
&bull; The range and nature of activities that occurred.<br />
&bull; Dialogue/behaviors that illustrate codes you gave, especially for teaching techniques and student engagement.<br />
&bull; Teacher's actions that appear to have affected students' engagement or cognitive demand modes.<br />
&bull; Evidence of variability among students (e.g., if small groups, to what extent did groups behave and engage similarly?)
</p>
<textarea name="narrative"></textarea>
</blockquote>
<input id="maxTime" type="hidden" name="time" value="0" />
<input class="submitMargin" type="submit" name="submit" value="Next Step" />
</form>
<?php include("include/footer.php"); ?>