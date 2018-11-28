<?php 
include("header.php");
$connect = new mysqli("127.0.0.1", "root", "", "test");
if(isset($_POST["custid"])) {
$sql = "insert into myorders_temp values (" .
$_POST["orderid"] . "," .
$_POST["custid"] . "," .
$_POST["emplid"] . ",'" .
$_POST["datetime"] . "')";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
}
echo "<br/>";
$sql = "insert into myorderdetails_temp values (" .
$_POST["orderid"] . "," .
$_POST["proid"] . "," .
$_POST["quan"] . "," .
$_POST["price"] . ")";
$result = $connect->query($sql);
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
echo "<br/>";
$result = $connect->query("select * from myproducts where proid = " . $_POST["proid"]);
if ($result->num_rows > 0) {
  if($row = $result->fetch_assoc()) { 
    $quan = $row["quan"]; 
    $sql="update myproducts set quan=".($quan - $_POST["quan"]) ." where proid=".$_POST["proid"]; 
    $result_pro = $connect->query($sql);
    if($result_pro === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
  }
}
if($result === FALSE)  echo "$sql : failed"; else echo "$sql : succeeded";
?>
<script type="text/javascript">
function getprice(){ getprice1(); getprice2(); }
function getprice2() {  
  var xmlHttp;
  try { xmlHttp=new XMLHttpRequest(); } catch (e) {
  try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
  try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) { return false; } } }
  xmlHttp.onreadystatechange=function() {
    if(xmlHttp.readyState==4) { document.orderform.name.value=xmlHttp.responseText; }
  }
  xmlHttp.open("GET","mygetname.php?proid=" + document.orderform.proid.value  , true);
  xmlHttp.send(null);
}

function getprice1() {  
  var xmlHttp;
  try { xmlHttp=new XMLHttpRequest(); } catch (e) {
  try { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
  try { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) { return false; } } }
  xmlHttp.onreadystatechange=function() {
    if(xmlHttp.readyState==4) { document.orderform.price.value=xmlHttp.responseText; }
  }
  xmlHttp.open("GET","mygetprice.php?proid=" + document.orderform.proid.value  , true);
  xmlHttp.send(null);
}
</script>
<form name=orderform action=insertorderprocess.php method=post>
<br>
<table border=1 bgcolor=#ffffdd>
<tr><td>รหัสเลขใบสั่ง</td><td><input name=orderid value=<?php echo $_POST["orderid"]; ?> readonly>
<tr><td>วันที่</td><td><input name=datetime value=<?php echo date('Y/m/d H:i:s'); ?> readonly><br/>
<tr><td>รหัสสินค้า</td><td><input name=proid onkeyup="getprice();" autocomplete="off"></td></tr>
<tr><td>ชื่อสินค้า</td><td><input name=name autocomplete="off"></td></tr>
<tr><td>จำนวน</td><td><input name=quan autocomplete="off"></td></tr>
<tr><td>ราคา</td><td><input name=price autocomplete="off"></td></tr>
</table>
<input type=submit value=orderdetail_process>
</form>
<?php
$result = $connect->query("select * from myorderdetails_temp");
echo $result->num_rows . "<ol>";
if ($result->num_rows > 0) {
  $sum = 0; 
  while($row = $result->fetch_assoc()) {
    $sum += ($row['quan'] * $row['price']);   
    echo  "<li> [proid = " . $row['proid'] . " ] ".  $row['quan'] .  " * " . 
    $row['price'] . " = " . ($row['quan'] * $row['price']) . "</li>";
  } 
}
echo "<br/>sum = $sum</ol><a href=insertorderconfirm.php>confirm this order and save</a>" ;
$connect->close(); 

include("footer.php");
?>