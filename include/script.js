/*
 * addrow.js - an example JavaScript program for adding a row of input fields
 * to an HTML form
 *
 * This program is placed into the public domain.
 *
 * The original author is Dwayne C. Litzenberger.
 * Home page: http://www.dlitz.net/software/addrow/
 */
function addRow() {
    /* Declare variables */
    var elements, templateRow, rowCount, row, className, newRow, element;
    var i, s, t;
    
    /* Get and count all "tr" elements with class="row".    The last one will
     * be serve as a template. */
    if (!document.getElementsByTagName)
        return false; /* DOM not supported */
    elements = document.getElementsByTagName("tr");
    templateRow = null;
    rowCount = 0;
    for (i = 0; i < elements.length; i++) {
        row = elements.item(i);
        
        /* Get the "class" attribute of the row. */
        className = null;
        if (row.getAttribute)
            className = row.getAttribute('class')
        if (className == null && row.attributes) {    // MSIE 5
            /* getAttribute('class') always returns null on MSIE 5, and
             * row.attributes doesn't work on Firefox 1.0.    Go figure. */
            className = row.attributes['class'];
            if (className && typeof(className) == 'object' && className.value) {
                // MSIE 6
                className = className.value;
            }
        } 
        
        /* This is not one of the rows we're looking for.    Move along. */
        if (className != "row_to_clone")
            continue;
        
        /* This *is* a row we're looking for. */
        templateRow = row;
        rowCount++;
    }
    if (templateRow == null)
        return false; /* Couldn't find a template row. */
    
    /* Make a copy of the template row */
    newRow = templateRow.cloneNode(true);

    /* Change the form variables e.g. price[x] -> price[rowCount] */	
	var inputs = newRow.getElementsByTagName("input");
	var selects = newRow.getElementsByTagName("select");
	var spans = newRow.getElementsByTagName("span");
	
	for (i = 0; i < spans.length; i++) {
		spans.item(i).innerText = 0;
	}
	
    for (i = 0; i < inputs.length + selects.length; i++) {
		element = (i < inputs.length) ? inputs.item(i) : selects.item(i-inputs.length);
        s = null;
        s = element.getAttribute("name");
        if (s == null)
            continue;
        t = s.split("[");
        if (t.length < 2)
            continue;
        s = t[0] + "[" + rowCount.toString() + "]";
        element.setAttribute("name", s);
        element.value = "";
		element.checked = "";
		element.selected = "";
    }
    //(parseInt(newRow.cells[0].innerHTML.slice(0, -4))+2) + " min";
    /* Add the newly-created row to the table */
	var x = newRow.cells[0].innerHTML;
	var y = x.split("-");
	y[1] = y[1].slice(0, -4);
	newRow.cells[0].innerHTML = (parseInt(y[0])+2) + "-" + (parseInt(y[1])+2) + " min";
    templateRow.parentNode.appendChild(newRow);
	
	// Add 2 mins to #maxTime
	var maxTime = document.getElementById('maxTime');
	var maxTimeValue = parseInt(maxTime.value) + 2;
	maxTime.value = maxTimeValue;
    return true;
}

var w,x,y,z;
var updateClockInterval = 1000;
var addRowInterval = 120000; // 2 minutes = 120000
var fadeInterval = 120000;
var time = 0;

function itsTime() {
	addRow();
	return true;
}
function formatTime(time) { 
	var seconds = time % 60;
	var minutes = (time - seconds) / 60;
	return (minutes > 9 ? minutes : "0" + minutes) + ":" + (seconds > 9 ? seconds : "0" + seconds);
}
function fadeMe() {
	$('#ite').fadeIn(600).delay(600).fadeOut(500);
}
function tick() {
	var currentTime = new Date();
	document.getElementById('clocka').innerHTML = (currentTime.getHours() > 9 ? currentTime.getHours() : "0" + currentTime.getHours()) + ":" +
												  (currentTime.getMinutes() > 9 ? currentTime.getMinutes() : "0" + currentTime.getMinutes()) + ":" +
												  (currentTime.getSeconds() > 9 ? currentTime.getSeconds() : "0" + currentTime.getSeconds());
}
function updateClock() { 
	time++;
	document.getElementById('clockb').innerHTML = formatTime(time);
}
function startRows(val) { 
	document.getElementById('start').style.visibility = "hidden";
	x = setInterval(itsTime, addRowInterval);
	y = setInterval(updateClock, updateClockInterval);
	z = setInterval(fadeMe, fadeInterval);
	return true;
}
function stopRows() {
	clearInterval(x);
	clearInterval(y);
	clearInterval(z);
	return true;
}