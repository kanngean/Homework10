<?php 
session_start();
include("header.php");
if(!isset($_SESSION["user"]) || $_SESSION["user"] !="pass") {
header("Location: signin.php");
	exit;
}
include('header.php');
/*include('head.php');*/
# เผยแพร่ใน http://www.thaiall.com/perlphpasp/source.pl?9137
# ===
# ส่วนกำหนดค่าเริ่มต้นของระบบ
$host     = "localhost";
$db       = "test";  
$tb       = "myorders"; 
$user     = "root"; // รหัสผู้ใช้ ให้สอบถามจากผู้ดูแลระบบ
$password = "";    // รหัสผ่าน ให้สอบถามจากผู้ดูแลระบบ
$create_table_sql = "create table test (id varchar(20),  ns varchar(20), na varchar(20), salary varchar(20))";
if (isset($_REQUEST{'action'})) $act = $_REQUEST{'action'}; else $act = "";
# ===
# ส่วนแสดงผลหลัก ทั้งปกติ และหลังกดปุ่ม del หรือ edit
if (strlen($act) == 0 || $act == "del" || $act == "edit") {
  $connect = new mysqli($host,$user,$password,$db);
  $result = $connect->query("select * from $tb")  or die ("phpmyadmin - " . $create_table_sql . "<br/>" . mysql_error());
  echo "<table>";
  while ($o = $result->fetch_object()) {
    if (isset($_REQUEST{'orderid'}) && $_REQUEST{'orderid'}  == $o->orderid) $chg = " style='background-color:#f9f9f9"; else $chg = " readonly style='background-color:#ffffdd";
    echo "<tr><form action='' method=post>
      <td><input name=orderid size=5 value='". $o->orderid . "' style='background-color:#dddddd' readonly></td>
      <td><input name=custid size=40 value='". $o->custid . "' $chg'></td>
	  <td><input name=emplid size=40 value='". $o->emplid . "' $chg'></td>
      <td><input name=datetime size=20 value='". $o->datetime . "' $chg;text-align:right'></td>
      <td>";
    if (isset($_REQUEST{'orderid'}) && $_REQUEST{'orderid'} == $o->orderid) {
      if ($act == "del") echo "<input type=submit name=action value='del : confirm' style='height:40;background-color:yellow'>";
      if ($act == "edit") echo "<input type=submit name=action value='edit : confirm' style='height:40;background-color:#aaffaa'>";
    } else {
      echo "<input type=submit name=action value='del' style='height:26'> <input type=submit name=action value='edit' style='height:26'>";
    }
    echo "</td></form></tr>";
  }	
  echo "<tr><form action='' method=post><td>
  <input name=orderid size=5></td><td>
  <input name=custid size=40></td><td>
  <input name=emplid size=40></td><td>
  <input name=datetime size=20></td><td>
  <input type=submit name=action value='add' style='height:26'></td></tr>
  </form></table>";
  if (isset($_SESSION["	"])) echo "<br>".$_SESSION["msg"];
  $_SESSION["msg"] = ""; 
  /*include('foot.php');*/
  exit;
} 
# ===
# ส่วนเพิ่มข้อมูล
if ($act == "add") {
   $connect = new mysqli($host,$user,$password,$db);
   $result = $connect->query("insert into myproducts (orderid,custid,emplid,datetime) values('". 
	   $_REQUEST{'orderid'} . "','". 
	   $_REQUEST{'custid'} . "','".
	   $_REQUEST{'emplid'} . "','".
	   $_REQUEST{'datetime'} . "')");   
  if ($result) $_SESSION["msg"] = "insert : completely";
  mysqli_close($connect);  
  header("Location: ". $_SERVER["SCRIPT_NAME"]);
}
# ===
# ส่วนลบข้อมูล
if ($act == "del : confirm") {
  $connect = new mysqli($host,$user,$password,$db);
   $result = $connect->query("delete from myproducts where orderid ='". $_REQUEST{'orderid'} . "'");   
  if ($result) $_SESSION["msg"] = "delete : completely";
mysqli_close($connect);
  header("Location: ". $_SERVER["SCRIPT_NAME"]);
}
# ===
# ส่วนแก้ไขข้อมูล
if ($act == "edit : confirm") {
  $connect = new mysqli($host,$user,$password,$db);
  $result = $connect->query("update $tb set custid ='". 
	  $_REQUEST{'custid'} . "',  emplid ='".
	   $_REQUEST{'emplid'} . "',  datetime ='".
	  $_REQUEST{'datetime'} . "' where orderid =" . 
	  $_REQUEST{'orderid'});      
  if ($result) $_SESSION["msg"] = "edit : completely";
  mysqli_close($connect);
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=myorders1.php\" />";
}

include("footer.php");

?>