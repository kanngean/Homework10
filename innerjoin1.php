<td><a href="menu02sub.php">Home</a></td>
<?php
include("header.php");
echo "<table border=2>";
  $conn = new mysqli("localhost","root","","meaw");
  $r = $conn->query("select orders.*, employees.* from (orders inner join employees on orders.employeeid = employees.employeeid)");	
  $s = 0;
  while ($o = $r->fetch_object()) {
$s++;
    echo 
"<tr><td>".$s."</td><td>".$o->OrderID
."</td><td>".$o->EmployeeID
."</td><td>".$o->CustomerID
."</td><td>".$o->FirstName
."</td><td>". $o->Title
."</td><td>". $o->LastName
."</td></tr>";
}
echo"</table>";
include("footer.php");
?>