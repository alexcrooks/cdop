<?php include("include/header.php"); ?>
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
<h1>Classroom Dynamics Observation Protocol (CDOP), ver 7 (as of 19 May 2013)</h1>
This protocol was adapted from: Hora, M., & Ferrare, J.. (2009). Structured observation protocol for instruction
in Institutions of Higher Education (IHEs). Madison, WI: University of Wisconsin-Madison, Wisconsin Center for Education Research.
<br /><br /><br />
<form method="post" action="process.php">
<table>
<tr>
<td>
<b>Observer</b>
<blockquote>
<div id="lbl"><label>Name:</label><input type="text" name="observer_name" value="Name" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Name' ? '' : this.value);" /></div>
<div id="lbl"><label>Institution:</label><input type="text" name="observer_institution" value="Institution" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Institution' ? '' : this.value);" /></div>
<div id="lbl"><label>Location in Class:</label><input type="text" name="observer_location" value="Location in Class" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Location in Class' ? '' : this.value);" /></div>
</blockquote>
</td>
<td>
<b>Class</b>
<blockquote>
<div id="lbl"><label>Name, Number, Section:</label><input type="text" name="class_name" value="Name, Number, Section" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Name, Number, Section' ? '' : this.value);" /></div>
<div id="lbl"><label>Instructor Name:</label><input type="text" name="instructor_name" value="Instructor Name"  class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Instructor Name' ? '' : this.value);" /></div>
<div id="lbl"><label>Instructor Department:</label><input type="text" name="instructor_department" value="Instructor Department" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Instructor Department' ? '' : this.value);" /></div>
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
<td title="Listening">L</td>
<td title="Individual thinking/problem solving">Ind</td>
<td title="Clicker question discussion">CG</td>
<td title="Group worksheet activity">WG</td>
<td title="Group activity">OG</td>
<td title="Answering a question posed by instructor">AnQ</td>
<td title="Student asks question">SQ</td>
<td title="Class discussion">WC</td>
<td title="Making predictions (e.g. outcome of demo)">Prd</td>
<td title="Student presentation">SP</td>
<td title="Test/quiz">TQ</td>
<td title="Waiting (no instructor, technical issues, instructor busy)">W</td>
<td title="Other">O</td>

<td title="Lecturing">Lec</td>
<td title="Real-time writing">RtW</td>
<td title="Instructor feedback on question/activity">FUp</td>
<td title="Posing non-clicker question to students">PQ</td>
<td title="Clicker question">CQ</td>
<td title="Listening to/answering student questions">AnQ</td>
<td title="Moving through class and guiding student learning">MG</td>
<td title="Focus on small group of individuals">1o1</td>
<td title="Demo/video/photo/simulation">D/V</td>
<td title="Administration">Adm</td>
<td title="Waiting">W</td>
<td title="Other">O</td>
</tr>
<tr class="row_to_clone">
<td>0-2 min</td>

<td title="Listening"><input type="checkbox" value="1" name="table_L[0]" class="checkbox_reg" /></td>
<td title="Individual thinking/problem solving"><input type="checkbox" value="1" name="table_Ind[0]" class="checkbox_reg" /></td>
<td title="Clicker question discussion"><input type="checkbox" value="1" name="table_CG[0]" class="checkbox_reg" /></td>
<td title="Group worksheet activity"><input type="checkbox" value="1" name="table_WG[0]" class="checkbox_reg" /></td>
<td title="Group activity"><input type="checkbox" value="1" name="table_OG[0]" class="checkbox_reg" /></td>
<td title="Answering a question posed by instructor"><input type="checkbox" value="1" name="table_AnQS[0]" class="checkbox_reg" /></td>
<td title="Student asks question"><input type="checkbox" value="1" name="table_SQ[0]" class="checkbox_reg" /></td>
<td title="Class discussion"><input type="checkbox" value="1" name="table_WC[0]" class="checkbox_reg" /></td>
<td title="Making predictions (e.g. outcome of demo)"><input type="checkbox" value="1" name="table_Prd[0]" class="checkbox_reg" /></td>
<td title="Student presentation"><input type="checkbox" value="1" name="table_SP[0]" class="checkbox_reg" /></td>
<td title="Test/quiz"><input type="checkbox" value="1" name="table_TQ[0]" class="checkbox_reg" /></td>
<td title="Waiting (no instructor, technical issues, instructor busy)"><input type="checkbox" value="1" name="table_W[0]" class="checkbox_reg" /></td>
<td title="Other"><input type="checkbox" value="1" name="table_SO[0]" class="checkbox_reg" /></td>

<td title="Lecturing"><input type="checkbox" value="1" name="table_Lec[0]" class="checkbox_reg" /></td>
<td title="Real-time writing"><input type="checkbox" value="1" name="table_RtW[0]" class="checkbox_reg" /></td>
<td title="Instructor feedback on question/activity"><input type="checkbox" value="1" name="table_FUp[0]" class="checkbox_reg" /></td>
<td title="Posing non-clicker question to students"><input type="checkbox" value="1" name="table_PQ[0]" class="checkbox_reg" /></td>
<td title="Clicker question"><input type="checkbox" value="1" name="table_CQ[0]" class="checkbox_reg" /></td>
<td title="Listening to/answering student questions"><input type="checkbox" value="1" name="table_AnQI[0]" class="checkbox_reg" /></td>
<td title="Moving through class and guiding student learning"><input type="checkbox" value="1" name="table_MG[0]" class="checkbox_reg" /></td>
<td title="Focus on small group of individuals"><input type="checkbox" value="1" name="table_1o1[0]" class="checkbox_reg" /></td>
<td title="Demo/video/photo/simulation"><input type="checkbox" value="1" name="table_DV[0]" class="checkbox_reg" /></td>
<td title="Administration"><input type="checkbox" value="1" name="table_AD[0]" class="checkbox_reg" /></td>
<td title="Waiting"><input type="checkbox" value="1" name="table_N[0]" class="checkbox_reg" /></td>
<td title="Other"><input type="checkbox" value="1" name="table_IO[0]" class="checkbox_reg" /></td>

<td><select name="table_Eng[0]" class="select_eng"><option value="">?</option><option value="Low">Low</option><option value="Med">Med</option><option value="High">High</option></select></td>

<td><input type="text" name="table_Comments[0]" class="text_comments" /></td>
</tr>
</table>
<?php include("include/legend.php"); ?>
<b>Room Information</b>
<blockquote>
<div id="lbl"><label>Room Layout:</label><input type="text" name="room_layout" value="Room Layout" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Room Layout' ? '' : this.value);" /></div>
</blockquote><br />
<b>Class</b>
<blockquote>
<div id="lbl"><label># Students Enrolled:</label><input type="text" name="class_numstudentsenrolled" value="# Students Enrolled" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == '# Students Enrolled' ? '' : this.value);" /></div>
<div id="lbl"><label># Students Present (iClicker):</label><input type="text" name="class_numstudentspresent" value="# Students Present (iClicker)" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == '# Students Present (iClicker)' ? '' : this.value);" /></div>
<div id="lbl"><label>Unusual Notes About Class:</label><input type="text" name="class_unusual" value="Unusual Notes About Class" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Unusual Notes About Class' ? '' : this.value);" /></div>
<div id="lbl"><label>How Varied is the Whole Course?:</label><select name="class_wholebalance">
<option value="">How Varied is the Whole Course?</option>
<option value="0/100">0% Active Students/100% Instructor Delivery</option>
<option value="20/80">20/80</option>
<option value="40/60">40/60</option>
<option value="60/40">60/40</option>
<option value="80/20">80/20</option>
<option value="100/0">100/0</option>
</select></div>
<div id="lbl"><label>How Varied is this Class?:</label><select name="class_thisbalance">
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
<b>What is Used by the Instructor?</b>
<blockquote>
<input type="checkbox" value="1" name="iu_powerpoint" /> Powerpoint
<input type="checkbox" value="1" name="iu_tablet" /> Tablet
<input type="checkbox" value="1" name="iu_projector" /> Projector
<input type="checkbox" value="1" name="iu_iclicker" /> iClicker
<input type="checkbox" value="1" name="iu_whiteboard" /> Whiteboard/Blackboard
<input type="checkbox" value="1" name="iu_microphone" /> Microphone
<input type="checkbox" value="1" name="iu_ta" /> TA<br /><br />
<div id="lbl"><label>Other:</label><input type="text" name="iu_other" value="Other" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Other' ? '' : this.value);" /></div>
<div id="lbl"><label>Comments:</label><input type="text" name="iu_comments" value="Comments" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Comments' ? '' : this.value);" /></div>
</blockquote><br />
<b>What is Used By Students?</b>
<blockquote>
<input type="checkbox" value="1" name="su_nothing" /> Nothing
<input type="checkbox" value="1" name="su_papernotes" /> Paper Notes
<input type="checkbox" value="1" name="su_givennotes" /> Given Notes
<input type="checkbox" value="1" name="su_laptop" /> Laptop
<input type="checkbox" value="1" name="su_distractor" /> Distractor<br /><br />
<div id="lbl"><label>Other:</label><input type="text" name="su_other" value="Other" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Other' ? '' : this.value);" /></div>
<div id="lbl"><label>Comments:</label><input type="text" name="su_comments" value="Comments" class="text_main" onfocus="this.style.color = '#000'; this.value = (this.value == 'Comments' ? '' : this.value);" /></div>
</blockquote><br />
<b>Class Narrative (field notes)</b>
<blockquote>
<p class="hideonprint">
Information could include:<br />
&bull; The structure of the lesson (e.g., how the instructor sequenced material, the narrative arc of the class)<br />
&bull; The range and nature of activities that occurred.<br />
&bull; Dialogue/behaviors that illustrate codes you gave, especially for teaching techniques and student engagement.<br />
&bull; Teacher�s actions that appear to have affected students� engagement or cognitive demand modes.<br />
&bull; Evidence of variability among students (e.g., if small groups, to what extent did groups behave and engage similarly?)
</p>
<textarea name="narrative"></textarea>
</blockquote>
<input id="maxTime" type="hidden" name="time" value="0" />
<input class="submitMargin" type="submit" name="submit" value="Next Step" />
</form>
<?php include("include/footer.php"); ?>