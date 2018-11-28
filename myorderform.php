<?php
session_start();
include("header.php");
if(!isset($_SESSION["user"]) || $_SESSION["user"] !="pass") {
header("Location: signin.php");
	exit;
}
$connect = new mysqli("127.0.0.1", "root", "", "test");
$result = $connect->query("select orderid from myorders order by orderid desc limit 0,1");
$lastorderid = 1;
if ($result->num_rows > 0) 
  if($row = $result->fetch_assoc()) $lastorderid = $row['orderid'] + 1;
$connect->close(); 
?>
<form action=insertorderform.php method=post>
<table border=1 bgcolor=#dddddd>
<tr><td>รหัสใบสั่งซื้อ</td><td><input name=orderid value="<?php echo $lastorderid; ?>"><br/>
<tr><td>รหัสลูกค้า</td><td><input name=custid autocomplete="off"><br/>
<tr><td>รหัสพนักงาน</td><td><input name=emplid autocomplete="off"><br/>
</table>
<input type=submit value=order_process>
</form>

<?php include("footer.php"); ?> 
