<td><a href="menu02sub.php">Home</a></td>
<?php
include("header.php");
echo "<table border=2>";
  $conn = new mysqli("localhost","root","","meaw");
  $r = $conn->query("select products.*, suppliers.* from (products inner join suppliers on products.supplierid = suppliers.supplierid)
  where products.UnitsInStock > 100");	
  $s = 0;
  while ($o = $r->fetch_object()) {
$s++;
    echo 
"<tr><td>".$s."</td><td>".$o->SupplierID
."</td><td>".$o->CompanyName
."</td><td>".$o->ContactName
."</td><td>". $o->ProductName
."</td><td>". $o->UnitPrice
."</td><td>". $o->UnitsInStock

."</td></tr>";
}
echo"</table>";
include("footer.php");
?>