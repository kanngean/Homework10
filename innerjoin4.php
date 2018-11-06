<td><a href="menu02sub.php">Home</a></td>
<?php
include("header.php");
echo "<table border=2>";
  $conn = new mysqli("localhost","root","","meaw");
  $r = $conn->query("select orderdetails.*, products.* from (orderdetails inner join products on orderdetails.productid = products.productid)");	
  $s = 0;
  while ($o = $r->fetch_object()) {
$s++;
    echo 
"<tr><td>".$s."</td><td>".$o->OrderID
."</td><td>".$o->ProductID
."</td><td>". $o->QuantityPerUnit
."</td><td>".$o->UnitPrice
."</td><td>". $o->ProductName
."</td></tr>";
}
echo"</table>";
include("footer.php");
?>