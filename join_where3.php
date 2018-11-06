<td><a href="menu02sub.php">Home</a></td>
<?php
include("header.php"); 

echo "<table border=2>";
  $conn = new mysqli("localhost","root","","meaw");
  $r = $conn->query("select orderdetails.*, orders.* from (orderdetails inner join orders on orderdetails.orderid = orders.orderid)
  group by orders.employeeid");	
  $s = 0;
  while ($o = $r->fetch_object()) {
$s++;
    echo 
"<tr><td>".$s."</td><td>".$o->OrderID
."</td><td>".$o->ProductID
."</td><td>".$o->CustomerID
."</td><td>". $o->EmployeeID
."</td><td>". $o->UnitPrice
."</td><td>". $o->Quantity
."</td><td>". $o->Discount
."</td></tr>";
}
echo"</table>"; 
include("footer.php");
?>