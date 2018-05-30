<?php
include('../configs/conf.php');
function onlinestatus($hostip, $portnr) {
  error_reporting(0);

  $fp = (fsockopen($hostip, $portnr,$errno,$errstr,3));

  if($fp) {
    return "<font color='00ff00'>Online</font>";
  }else{
    return "<font color='ff0000'>Offline</font>";
  }
}
echo "Auth is ".onlinestatus($server_address, $auth_port)."<br>";
mysqli_select_db($conn, $dbname);
$stmt = $conn->prepare("SELECT name, address, port FROM realmlist");
$stmt->execute();
$stmt->bind_result($name, $address, $port);
$stmt->store_result();
if($stmt->num_rows > 0) {
  while($stmt->fetch()) {
    echo "$name is ".onlinestatus($address, $port)."<br>";
    //echo "<div class='progress'>";
    //echo "<div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width:50%'>";
    //echo "</div>";
    //echo "</div>";
  }
}
?>
