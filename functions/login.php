<?php
session_start();
include("../configs/conf.php");

function encryptsha($user,$pass) {
  $user = strtoupper($user);
  $pass = strtoupper($pass);
  return strtoupper(sha1($user.':'.$pass));
}

$username = $_POST['user'];
$password = encryptsha($username, $_POST['pass']);
$stmt = $conn->prepare("SELECT id FROM account WHERE username = ? AND sha_pass_hash = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->bind_result($id);
$stmt->store_result();
$stmt->fetch();
if($stmt->num_rows > 0) {
  $_SESSION['username'] = strtoupper($username);
  $_SESSION['id'] = $id;
  echo "<div class='alert alert-success'><strong>Success!</strong> You will be logged in.</div>";
}else{
  echo "<div class='alert alert-danger'><strong>Failed to Login!</strong> Username or Password is not correct!</div>";
}
?>
