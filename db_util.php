<?php

include_once 'shell_util.php';
include_once 'constants.php';

function getLabStatus($lab)
{

$conn = new mysqli(dbhostname, dbuser, dbpwd, dbschema);

if ($conn->connect_error) {
echo "getLabStatus::: Lab = " . $lab . " Failed to connect to MySQL: " . $conn->connect_error;
}

//echo "<script>alert(\"getLab Status for $lab\")</script>";

$query = "select ip from systems where lab='$lab'";
$result = $conn->query($query);

$ipList = "";

while($row = $result->fetch_assoc()) {
   $ipList .= $row['ip'] . " ";
}

//echo "All Ips = $ipList";

$cmd = "fping -a $ipList";
$upIps = executeCmd($cmd);

$upIps = str_replace("\n","','",$upIps);
//echo "UPips = $upIps";
//query the systems and update the present status
$query="update systems set status=1 where ip in ('$upIps')";
//echo $query;
$result = $conn->query($query);

$query="update systems set status=0 where ip not in ('$upIps') and lab='$lab'";
//echo $query;
$result = $conn->query($query);

$query = "SELECT sysno, ip, status from systems where lab='$lab'";

//echo $query;

$result = $conn->query($query);

return $result;

}
?>
