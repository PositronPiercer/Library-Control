

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
<link rel="stylesheet" type="text/css" href="creturn.css"/><script type="text/javascript" src="jq.js"></script> 
<script type="text/javascript" src="jq.js"></script> 
<script type="text/javascript" src="iframe.js"></script>
</head>
<body>
<button id="okiframe" onclick="ty()"  >>></button>

<?php
$entry=$_POST['entry'];
$book=$_POST['book_id'];
$conn=new mysqli("localhost","root","toor","test");


if($conn->connect_error)
{echo "connection error <br>";
}
else{
	//echo "connection success<br>";
}

if(mysqli_fetch_assoc($conn->query("SELECT COUNT(*) AS c FROM issued WHERE book_id='".$book."' AND entry='".$entry."'"))['c']<1)
{die (' <span class="error"> This book had not been issued by the student</span>');
}
else {
	
	$conn->query("DELETE FROM issued WHERE entry='".$entry."' AND book_id='".$book."'");
}
try{
$book_count=mysqli_fetch_assoc($conn->query("SELECT count FROM books WHERE book_id='".$book."'"))['count'];

$stud_name=mysqli_fetch_assoc($conn->query("SELECT name FROM stud WHERE entry='".$entry."'"))['name'];
echo '<span id="student_name">'.$stud_name.'</span>';


$book_name=mysqli_fetch_assoc($conn->query("SELECT name FROM books WHERE book_id='".$book."'"))['name'];
echo '<span id="book_name"> '.$book_name.'</span>';

$book_author=mysqli_fetch_assoc($conn->query("SELECT author FROM books WHERE book_id='".$book."'"))['author'];
echo '<span id="author">'.$book_author.'</span>';

$stud_mail=mysqli_fetch_assoc($conn->query("SELECT email FROM stud WHERE entry='".$entry."'"))['email'];
echo '<span id="mail">'.$stud_mail.'</span>';

if($conn->query("UPDATE books SET count=".($book_count+1)." WHERE book_id='".$book."'"))
{echo '<span class="status" > Returned </span>';
}
else {
	echo '<span class="status" > <font color="red:>Not Returned</font> </span>';
}


}
catch(exception $e){
	die('error');
}



$log="INSERT INTO log(date,time,entry,book_id,log) VALUES ('".date("Y/m/d")."','".date("H:i:s")."','".$entry."','".$book."','returned')";
//echo $log;
if($conn->query($log)){}
	//echo "<br>logged successfully";
else {echo '<span id="log">failed to log</span>';}




//------------------mail







?>


</body>
</html>