<?php
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo "<response>";

$conn=new mysqli("localhost","root","toor","test");


if($conn->connect_error)
{echo "connection error &lt;br&gt;";
}
else{
    //echo "connection success&lt;br&gt;";
}
echo " &lt;h2 id=&quot;thd&quot;&gt; Pending Submissions &lt;/h2&gt;";

echo "&lt;table border=0 id=&quot;tt&quot;&gt;&lt;tr&gt;&lt;th&gt;Entry No.&lt;/th&gt;&lt;th&gt;Book&lt;/th&gt;&lt;th&gt;Delay&lt;/th&gt;&lt;/tr&gt;";
$out =$conn->query("SELECT * FROM issued ORDER BY date_to_return");
//while($row=mysqli_fetch_assoc($out))
while($row=$out->fetch_assoc()){

    $delay=((new DateTime($row['date_to_return']))->diff(new DateTime(date("Y/m/d"))))->format("%r%a");
    if($delay>=0){
        echo "&lt;tr&gt;&lt;td&gt;".$row['entry']."&lt;/td&gt;&lt;td&gt;".$row['book_id']."&lt;/td&gt;&lt;td&gt;";
        if($delay>0)
        {
            echo '&lt;b&gt;&lt;font color="red"&gt;'.$delay.'&lt;/b&gt;&lt;/font&gt;';
        }
        else{
            echo '&lt;b&gt;&lt;font color="green"&gt;-------&lt;/b&gt;&lt;/font&gt;';
        }
        echo "&lt;/td&gt;&lt;/tr&gt;";

    }

}
echo "&lt;/table&gt;";
echo "</response>";
?>
