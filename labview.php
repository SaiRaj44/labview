<html>
<body>
<center>
<h2>CSE Lab Monitoring</h2>
<form name="form" method="post">
<br/>
<button name="submit" value="0" >SSL</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button name="submit" value="1" >DSL</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<br/><br/>
</form>
<?php

include_once 'db_util.php';

function displayData($lab)
{
//echo '<script>alert("displayData")</script>';
$result = getLabStatus($lab);

echo "<h3 style=\"color:blue\"> The Status of Systems are as follows</h3>";
echo "<br/><table border='1'>
<tr align='center'>
<th align='center'> Sysno</th>
<th align='center'> IP Addr </th>
<th align='center'> Status </th>
</tr>";
$color="1";
while($row = $result->fetch_assoc())
{
$status=$row['status'];
if ($status == 0){
	$color="red";
} else {
	$color="yellow";
}
echo "<tr bgcolor='" . $color . "'>";
echo "<td align='center'>" . $row['sysno'] . "</td>";
echo "<td align='center'>" . $row['ip'] . "</td>";
echo "<td align='center'>" . $row['status'] . "</td>";
echo "</tr>";
}
echo "</table>";

$conn->close();
} // function displayData ends


if($_POST["submit"]==0){ //SSL Lab
displayData("ssl");
}
else if($_POST["submit"]==1){ //DSL Lab
displayData("dsl");
}

?>
</center>
</body>
</html>
