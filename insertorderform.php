<?php $dt = new DateTime(); include("header.php"); ?>

<form action=insertorderprocess.php method=post>
<input name=orderid value=<?php echo $_POST["orderid"]; ?> readonly>
<input name=custid value=<?php echo $_POST["custid"]; ?> readonly>
<input name=emplid value=<?php echo $_POST["emplid"]; ?> readonly>
<input name=datetime value=<?php echo $dt->format('Y/m/d H:i:s'); ?> readonly><br/>
<table border=1 bgcolor=#ffffdd>
<tr><td>รหัสสินค้า</td><td><input name=proid autocomplete="off"></td></tr>
<tr><td>จำนวน</td><td><input name=quan autocomplete="off"></td></tr>
<tr><td>ราคา</td><td><input name=price autocomplete="off"></td></tr>
</table>
<input type=submit value=orderdetail_process>
</form>
<?php include("footer.php"); ?>

