<td><a href="menu02sub.php">Home</a></td>
<?php
include("header.php");
echo "<table border=2>";
  $conn = new mysqli("localhost","root","","meaw");
  $r = $conn->query("select products.*, suppliers.* from (products inner join suppliers on products.supplierid = suppliers.supplierid)");	
  $s = 0;
  while ($o = $r->fetch_object()) {
$s++;
    echo 
"<tr><td>".$s
."</td><td>".$o->ProductID
."</td><td>". $o->ProductName
."</td><td>". $o->QuantityPerUnit
."</td><td>". $o->UnitPrice
."</td><td>".$o->CompanyName
."</td><td>".$o->ContactName
."</td><td>". $o->ContactName
."</td><td>". $o->ContactTitle
."</td></tr>";
}
echo"</table>";
include("footer.php");
?>