<?php
  session_start();
  include('../configs/conf.php');
  mysqli_select_db($conn, $webdbname);
  $update_avatar = $conn->prepare("UPDATE accounts SET avatarpic = 'unknown.png' WHERE username = ?");
  $update_avatar->bind_param("s", $_SESSION['username']);
  $update_avatar->execute();
  header("refresh:0; ../ucp");
 ?>
