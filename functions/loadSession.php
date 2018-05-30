<?php
function getavatar($account) {
  include('configs/conf.php');
  mysqli_select_db($conn, $webdbname);
  $stmt = $conn->prepare("SELECT avatarpic FROM accounts WHERE username = ?");
  $stmt->bind_param("s", $account);
  $stmt->execute();
  $stmt->bind_result($avatar);
  $stmt->store_result();
  if($stmt->num_rows > 0) {
    while($stmt->fetch()) {
      if(file_exists('images/avatars/'.$avatar)){
        return $avatar;
      } else {
        $update_avatar = $conn->prepare("UPDATE accounts SET avatarpic = 'unknown.png' WHERE username = ?");
        $update_avatar->bind_param("s", $_SESSION['username']);
        $update_avatar->execute();
        return 'unknown.png';
      }
    }
  }
}

function getgmlevel($id, $type) {
  include("configs/conf.php");
  $stmt = $conn->prepare("SELECT gmlevel FROM account_access WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($gmLevel);
  $stmt->fetch();
  #$result = $stmt->get_result();1
  if($type == 0) {
    return $gmLevel;
  }elseif($type == 1) {
    switch($gmLevel) {
      case "None":
      return "Player";
      break;

      case"1":
      return "GM";
      break;

      case"2":
      return "Moderator";
      break;

      case"3";
      return "Admin";
      break;

      case"4":
      return "Console";
      break;

      default:
        return "Player";
        break;
    }
  } else {
    return "unknown type?";
  }
}

  function getcoins($id, $cointype) {
      include("configs/conf.php");
      mysqli_select_db($conn, $webdbname);
      $stmt = $conn->prepare("SELECT vp, dp FROM accounts WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($vp, $dp);
  		$stmt->store_result();
  		$stmt->fetch();
      if($stmt->num_rows() == 0) {
        $insert_acc = $conn->prepare("INSERT INTO accounts(id, username, avatarpic) VALUES (?, ?, 'unknown.png')");
        $insert_acc->bind_param("is", $id, $_SESSION['username']);
        $insert_acc->execute();
        return 0;
      } else {
        if ($cointype == 0) {
          return $vp;
        } elseif($cointype == 1) {
          return $dp;
        } else {
          return "unknown";
        }
      }

  }

  function loadSession($accDetails_text, $login_text, $first_text, $second_text, $thrid_text, $fourth_text) {
    if(!isset($_SESSION['username'])) {
      echo "<div class='card-header'>$login_text</div>";
      echo "<div class='card-body'>";
      echo "<div class='output'></div>";
      echo "<form action='../functions/login.php' method='POST' class='myForm' autocomplete='on'>";
      echo "<div class='form-group'>";
      echo "<label for='loginuser'>User:</label>";
      echo "<input type='text' class='form-control' id='loginuser' name='user'>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='loginpass'>Password:</label>";
      echo "<input type='password' class='form-control' id='loginpass' name='pass' autocomplete='new-password'>";
      echo "</div>";
      echo "<input type='submit' value='Login' class='btn btn-primary'>";
      echo "</form>";
      echo "</div>";
    }else{
        include('configs/conf.php');
        mysqli_select_db($conn, $dbname);
        $stmt = $conn->prepare("SELECT id, email, locked FROM account WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $stmt->bind_result($id, $email, $locked);
        $stmt->store_result();
        $stmt->fetch();
        if($locked == 0) {
          $locked = "Active";
        }elseif ($locked == 1) {
          $locked = "Locked";
        }
        echo "<div class='card-header'>$accDetails_text</div>";
        echo "<div class='card-body'>";
        echo "<table class='table left-panel-table'>";
        echo "<tr>";
        echo "<td>$first_text</td>";
        echo "<td>$second_text</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>".$_SESSION['username']."</strong></td>";
        echo "<td><strong>".getgmlevel($id, 1)."</strong></td>";
      #  echo "<td>".$locked."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$thrid_text</td>";
        echo "<td>$fourth_text</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><strong>".getcoins($id, 0)."</strong></td>";
        echo "<td><strong>".getcoins($id, 1)."</strong></td>";
        echo "</tr>";
        echo "</table>";
        echo "<a href='../functions/logout.php'>Logout</a>";
        echo "<div style='float: right;'><a href='/ucp'>User Panel</a></div>";
        echo "</div>";
    }
    return;
  }
?>
