<?php
// Including dbconf.php so that we can connect to the database
include("../configs/conf.php");

// Function to encrypt password from username:password to sha1 encryption
function encryptsha($user,$pass) {
  $user = strtoupper($user);
  $pass = strtoupper($pass);
  return strtoupper(sha1($user.':'.$pass));
}

// Setting up variables with a POST method from html form.
$username = $_POST['user'];
$password = encryptsha($username, $_POST['pass']);
$email = $_POST['email'];
$exp = $_POST['exp'];

// Checking if input with name pass matches input with name pass2
if($_POST['pass'] == $_POST['pass2']) {

  // Preparing the query (Only if pass matches pass2)
  $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, expansion) VALUES (?, ?, ?, ?)");
  // Binding the Parameters (Only if pass matches pass2)
  $stmt->bind_param("sssi", $username, $password, $email, $exp);
  // Trying to execute query to database (Only if pass matches pass2)
  if($stmt->execute()) {
    // Outputs this result inside <div class="output"></div> in the html form if the query was executed
    echo "<div class='alert alert-success'><strong>Success!</strong> Account $username has been created!</div>";
    $_SESSION['username'] = $username;
  }else{
    // Outputs this result inside <div class="output"></div> in the html form if the query was NOT executed
    //echo "<div class='alert alert-danger'><strong>Failed!</strong> ".$stmt->error."</div>";
    echo "<div class='alert alert-danger'><strong>Failed!</strong> Account with this name exists.</div>";
  }
}else{
  // Outputs this result inside <div class="output"></div> in the html form if the passwords missmatch
  echo "<div class='alert alert-warning'><strong>Failed!</strong> Passwords Missmatch</div>";
}
?>
