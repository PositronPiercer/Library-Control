<!DOCTYPE html>
<html>
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
<link rel="stylesheet" type="text/css" href="cstats.css">
<div id="headt"><h1><a href="index.php" id="headl"><span id="home">Library</span></a> Stats</h1></div>
</head>
<body>
<h5></h5>

	
<div class="dropdown">
<span id="dropdown_tit"> View stats by </span>
<div class="options">
<form action="stats.php" method="post" ><input type="hidden" value="date" name="view"><input class="val_imp" type="submit" value="Date"></form>
<form action="stats.php" method="post" ><input type="hidden" value="book_id" name="view"><input class="val_imp" type="submit" value="Book Id"></form>
<form action="stats.php" method="post" ><input type="hidden" value="entry" name="view"><input class="val_imp" type="submit" value="Entry No."></form>
<form action="stats.php" method="post" ><input type="hidden" value="sname" name="view"><input class="val_imp" type="submit" value="Student Name"></form>
<form action="stats.php" method="post" ><input type="hidden" value="bname" name="view"><input class="val_imp" type="submit" value="Book Name"></form>


</div>
</div>



	<?php //input value
@	$soption = $_POST['view'];
//echo "<br>".$soption;
if($soption=='date'){
	echo '<form class="sub_form" action="stats.php" method="post"><input  type="date" name="idate"><input class="gob" type="submit" value="go">';
	
	
}
if($soption=='book_id'){
	echo '<form class="sub_form" action="stats.php" method="post"><input placeholder="Enter Book Id" type="text" name="ibook_id"><input class="gob" type="submit" value="go">';
	
	
	
}
if($soption=='entry'){
	
	echo '<form class="sub_form" action="stats.php" method="post"><input placeholder="Enter entry no." type="text" name="ientry"><input class="gob" type="submit" value="go">';
}
if($soption=='sname'){
	echo '<form class="sub_form" action="stats.php" method="post"><input placeholder="Enter student\'s name"type="text" name="isname"><input class="gob" type="submit" value="go">';
	
}
if($soption=='bname'){
	echo '<form class="sub_form" action="stats.php" method="post"><input placeholder="Enter books\'s name"type="text" name="ibname"><input class="gob" type="submit" value="go">';
	
	
}

	
	?>
	
	<?php //computation
	if(isset($_POST['idate'])){
		$date=$_POST['idate'];
	echo '<span class="details"><b>Date:</b>'.$date.'</span>';
	
	try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
	echo '<table  id="date_table"><tr class="table_tit"> <th colspan=6><span >History since beginning of time</span></th></tr><tr><th>Time</th><th>Entry No.</th><th>Name</th><th>Book Id</th><th>Book Name</th><th>Log</th></tr>';
	$out=$conn->query("SELECT time,entry,book_id,log FROM log WHERE date='".$date."'");
	$issued=0;
	$returned=0;
	while($row=$out->fetch_assoc()){
		$book_id=$row['book_id'];
		$entry=$row['entry'];
		$time=$row['time'];
		$log=$row['log'];
		if($log=='issued')
		{$issued++;}
	if($log=='returned'){
		$returned++;
	}
		$name=mysqli_fetch_assoc($conn->query("SELECT name FROM stud WHERE entry='".$entry."'"))['name'];
		$bname=mysqli_fetch_assoc($conn->query("SELECT name FROM books WHERE book_id='".$book_id."'"))['name'];
		echo '<tr><td>'.$time.'</td><td>'.$entry.'</td><td>'.$name.'</td><td>'.$book_id.'</td><td>'.$bname.'</td><td>'.$log.'</td></tr>';
		
		
		
		
	}
	echo '</table>';
	echo "<br><div class=\"return_count\" ><b>Returned:</b> ".$returned." <b>Issued: </b>".$issued."  </div>";	}
	
	?>
	
	
	<?php
	if ((isset($_GET['ibook_id']))||(isset($_POST['ibook_id']))){
		
		if(isset($_POST['ibook_id'])){
			$ibook_id=$_POST['ibook_id'];
		}
		else $ibook_id=$_GET['ibook_id'];
		
	
	try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
	$issued=0;
	$returned=0;
	$bname=mysqli_fetch_assoc($conn->query("SELECT name FROM books WHERE book_id='".$ibook_id."'"))['name'];
	$auth=mysqli_fetch_assoc($conn->query("SELECT author FROM books WHERE book_id='".$ibook_id."'"))['author'];
	$total=mysqli_fetch_assoc($conn->query("SELECT total FROM books WHERE book_id='".$ibook_id."'"))['total'];
	$count=mysqli_fetch_assoc($conn->query("SELECT count FROM books WHERE book_id='".$ibook_id."'"))['count'];
	echo "<span class=\"details\"><b>Book Name:</b>".$bname."<b> Author: </b>".$auth;
	echo "<br><b>Total:</b>".$total." <b>Count:</b>".$count."</span><br>";
		$out=$conn->query("SELECT entry FROM issued WHERE book_id='".$ibook_id."'");
	echo "<br> <table  ><tr class=\"table_tit\"><th colspan=2><span >Students currently in possesion of this book</span></th></tr><tr><th>Name</th><th>Entry</th></tr>";
	while($row=$out->fetch_assoc()){
		$entry=$row['entry'];
		$name=mysqli_fetch_assoc($conn->query("SELECT name FROM stud WHERE entry='".$entry."'"))['name'];
		echo '<tr><td>'.$name.'</td><td>'.$entry.'</td></tr>';
		
		
	}
	echo '</table>';
		echo '<table  ><tr class="table_tit"><th colspan=5><span >History since beginning of time</span></th></tr><tr><th>Date</th><th>Time</th><th>Entry No.</th><th>Name</th><th>Log</th></tr>';
	$out=$conn->query("SELECT date,time,entry,log FROM log WHERE book_id='".$ibook_id."'");

	while($row=$out->fetch_assoc()){
		$date=$row['date'];
		$entry=$row['entry'];
		$time=$row['time'];
		$log=$row['log'];
		if($log=='issued')
		{$issued++;}
	if($log=='returned'){
		$returned++;
	}
		$name=mysqli_fetch_assoc($conn->query("SELECT name FROM stud WHERE entry='".$entry."'"))['name'];
		
		echo '<tr><td>'.$date.'</td><td>'.$time.'</td><td>'.$entry.'</td><td>'.$name.'</td><td>'.$log.'</td></tr>';
		
		
		
		
	}
	echo '</table>';
	echo "<br><div class=\"return_count\" ><b>Returned:</b> ".$returned." <b>Issued: </b>".$issued."  </div>";	

	
	}
	
	?>
	
	
	<?php
	if((isset($_POST['ientry']))||(isset($_GET['ientry']))){
		if(isset($_POST['ientry'])){
			$entry=$_POST['ientry'];
		}
		else $entry=$_GET['ientry'];
		
		try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
	
	$issued=0;
	$returned=0;
	$name=mysqli_fetch_assoc($conn->query("SELECT name FROM stud WHERE entry='".$entry."'"))['name'];
	echo "<span class=\"details\"><b>Entry:</b>".$entry." <b>Name: </b>".$name."</span><br>";
	echo "<br><br><table  ><tr class=\"table_tit\"><th colspan=2><span >Books currently in possession of this student</span></th></tr><tr><th>Book Id</th><th>Book Name</th></tr>";
	
	
	$out=$conn->query("SELECT book_id FROM issued WHERE entry='".$entry."'");
	
	while($row=$out->fetch_assoc()){
		$book_id=$row['book_id'];
		$bname=mysqli_fetch_assoc($conn->query("SELECT name FROM books WHERE book_id='".$book_id."'"))['name'];
		echo "<tr><td>".$book_id."</td><td>".$bname."</td></tr>";
		
	}
	echo "</table>";
	
	echo '<table  ><tr class="table_tit"><th colspan=5><span >History since beginning of time</span></th></tr><tr><th>Date</th><th>Time</th><th>Book Id</th><th>Book Name</th><th>Log</th></tr>';
	$out=$conn->query("SELECT date,time,book_id,log FROM log WHERE entry='".$entry."'");
	while($row=$out->fetch_assoc()){
		$book_id=$row['book_id'];
		$date=$row['date'];
		$time=$row['time'];
		$log=$row['log'];
		if($log=='issued')
		{$issued++;}
	if($log=='returned'){
		$returned++;
	}
		
		$bname=mysqli_fetch_assoc($conn->query("SELECT name FROM books WHERE book_id='".$book_id."'"))['name'];
		echo '<tr><td>'.$date.'</td><td>'.$time.'</td><td>'.$book_id.'</td><td>'.$bname.'</td><td>'.$log.'</td></tr>';
		
		
		
		
	}
	echo '</table>';
	echo "<br><div class=\"return_count\" ><b>Returned:</b> ".$returned." <b>Issued: </b>".$issued."  </div>";	
	
	}
	?>
	<?php
	if(isset($_POST['isname'])){
		$name=$_POST['isname'];
				try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
try{//fulltext search must be enabled
$out=$conn->query("SELECT name,entry FROM stud WHERE Match(name) Against('".$name."')");
}catch(exception $ty){
	die('connection failure');
}
echo "<br> <br><table  ><tr><th colspan=2>Please select the student</th></tr><tr><th>Name</th><th>Entry no.</th></tr>";
while($row=$out->fetch_assoc()){
	$entry=$row['entry'];
	$name=$row['name'];
	echo "<tr><td><a href=\"stats.php?ientry=".$entry."\">".$name."</a></td><td>".$entry."</td></tr>";
	
}
	echo "</table>";}
	?>

	
	<?php
	if(isset($_POST['ibname'])){
		$bname=$_POST['ibname'];
				try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
try{//fulltext search must be enabled
$out=$conn->query("SELECT name,book_id,author FROM books WHERE Match(name) Against('".$bname."')");
}catch(exception $ty){
	die('connection failure');
}
echo "<br> <br><table  ><tr><th colspan=3>Please select the book</th></tr><tr><th>Name</th><th>Author</th><th>Book Id</th></tr>";
while($row=$out->fetch_assoc()){
	$book_id=$row['book_id'];
	$name=$row['name'];
	$author=$row['author'];
	echo "<tr><td><a href=\"stats.php?ibook_id=".$book_id."\">".$name."</a></td><td>".$author."</td><td>".$book_id."</td></tr>";
	
}
	echo "</table>";}
	?>
</body>
</html>