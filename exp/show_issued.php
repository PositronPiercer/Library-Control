<?php
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo "<response>";



try{$conn= new mysqli('localhost','root','toor','test');}
	
catch(exception $e){die("connection failure");}
$entry=$_POST['entry'];

$out=$conn->query("SELECT COUNT(*) FROM issued WHERE entry='".$entry."'");
if(mysqli_fetch_assoc($out)['COUNT(*)']==0){
	echo "No books issued";
	die('</response>');
}
else{echo "&lt;table   id=&quot;issued_table&quot; &gt;";
$out=$conn->query("SELECT book_id FROM issued WHERE entry='".$entry."'");
while($row=$out->fetch_assoc()){
	$book=$row['book_id'];
	
	echo "&lt;tr&gt;&lt;td &gt;  ".$book."&lt;/td&gt;&lt;td &gt;&lt;form method=&quot;POST&quot; target=&quot;con_frame&quot; action=&quot;return.php&quot;&gt;&lt;input  type=&quot;hidden&quot; name=&quot;entry&quot; value=&quot;".$entry."&quot;&gt;&lt;input  type=&quot;hidden&quot; name=&quot;book_id&quot; value=&quot;".$book."&quot;&gt;  &lt;div class=&quot;sclm&quot; &gt; &lt;input type=&quot;submit&quot; class=&quot;sub&quot; onclick=&quot;returnClick()&quot;  value=&quot;return&quot;&gt; &lt;/div&gt; &lt;/form&gt;&lt;/td&gt;&lt;/tr&gt;"; 
}
echo "&lt;/table&gt;";
}
echo "</response>";

?>