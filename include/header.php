<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Classroom Dynamics Observation Protocol</title>
<script type="text/javascript" src="include/script.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {packages: ['corechart']});
</script>
<style type="text/css">
body { margin: 10px; font-family: Helvetica, Arial, sans-serif; font-size: 10pt; background: url('img/debut_light.png') repeat; }
h1 { font-size: 18pt; }
h2 { font-size: 14pt; }
textarea { width: 700px; height: 125px; font-family: Helvetica, Arial, sans-serif; }
table tr { vertical-align: top; }
label { display: none; }
img { vertical-align: bottom; }
input[type=submit] { font-size: 14pt; }
a { text-decoration: none; color: #069; }
a:hover { text-decoration: underline; }

.copyheader { font-weight: bold; }
.select_okgood, .select_eng, .select_blooms { font-size: 8pt; width: 35px; overflow: hidden; }
.text_hap { width: 40px; }
.text_comments { width: 100px; }
.text_main { width: 200px; color: #ccc; }
.viewPageLane { margin-top: 6px; }

#legend { width: 60%; background-color: #eee; }
#legend td { vertical-align: top; }
#showHideLegend { width: 60%; margin-bottom: 30px; background-color: #ccc; font-weight: bold; }
#mainTable { text-align: center; }
#mainTable tr:nth-child(even) { background-color: #dddddd; }
#mainTable tr:nth-child(1), #mainTable tr:nth-child(2) { background: none; }
#lbl select, #lbl input[type=text], textarea { padding: 3px 5px; font-size: 12pt; }
td.tableFieldTaken { min-width: 20px; min-height: 20px; }
img.tableFieldTaken { width: 100%; height: 100%; }

#floatingClock, #start, #ite { -webkit-border-radius: 7px; -moz-border-radius: 7px; border-radius: 7px; font-weight: bold; text-align: center; color: white; background-color: #344152; background: url('img/low_contrast_linen.png') repeat; font-size: 14pt; z-index: 5; }
#floatingClock { position: fixed; top: 100px; right: 50px; width: 180px; padding: 10px; }
#start { position: relative; left: 200px; margin-bottom: -70px; padding-top: 15px; width: 500px; height: 40px; }
#ite { display: none; position: fixed; top: 15%; left: 20%; padding: 15% 10%; width: 40%; height: 10%; z-index: 6; }
.clockLabel { font-size: 12pt; }
.split { margin-top: 35px; }
.splitSmall { margin-top: 7px; }

#graphManager { margin: 25px; display: none; }
.submitNoMargin { margin: 10px 0px; padding: 5px 10px; }
.submitMargin { margin: 50px 0px; padding: 10px 20px; }
.viewPageToPrint { display: none; }

@media print {
#floatingClock, #start, #ite, #legend, .hideonprint, .viewPageNoPrint, input[type=submit] { display: none; }
label { display: inline; margin-right: 5px; font-weight: bold; }
#lbl { margin-top: 6px; }
#lbl label { display: block; }
#mainTable { page-break-after: always; }
.viewPageToPrint { display: inline; }
}
</style>
</head>
<body>