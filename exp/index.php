

<html>

<script type="text/javascript" src="ajax.js"></script>

<head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Inder" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Tauri" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Electrolize" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<h1><span id="hd">Library Control</span></h1><br>
<link rel="stylesheet" type="text/css" href="cindex.css"/>
<a id="stat" href="stats.php">stats</a>
</head>
<body onload="process()">
<script type="text/javascript" src="jq.js"></script>
<script type="text/javascript" src="com_js.js"></script>
<p id="info">All books and other educational materials displayed here are just for demo. <br> Site Author:positron.piercer</p>

<div id="return">

</div>
<div id="issue">
<h2> Issue </h2>
<form method="post" action="issue.php" class="input" target="con_frame">
<b>Entry No. : </b><input type="text" id="temt"  class="field" name="entry"><br><br>
<b>Book Id  :   </b><input type="text" class="field" name="book_id" id="bokk"><br><br>
<input type="submit" class="sub"  value="Issue">
</form>

</div>





<div id="pend">
</div>
<iframe  name="con_frame" id="cframe" width="700px" height="432px"></iframe>


</body>
</html>