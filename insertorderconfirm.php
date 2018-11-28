<?php 
include("header.php");
$connect = new mysqli("127.0.0.1", "root", "", "test");
$sql = "insert into myorders select * from myorders_temp";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
echo "<br/>";
$sql = "insert into myorderdetails select * from myorderdetails_temp";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
echo "<br/>";
$sql = "delete from myorders_temp";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
echo "<br/>";
$sql = "delete from myorderdetails_temp";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
$connect->close();
include("footer.php");
?>
<br/><a href=myorderform.php>new orderid</a>