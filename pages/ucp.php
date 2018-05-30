
<div class="col-md-6">
	<div class="card">
	<?php
	function BanStatus($id)
	{
		include('configs/conf.php');
		$stmt = $conn->prepare("SELECT active FROM account_banned WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($banactive);
		$stmt->store_result();
		$stmt->fetch();
		switch ($banactive) {
			case '1':
						return "Banned";
				break;

			case '0':
						return "Ban Lifted";
						break;

			default:
						return "Never banned";
				break;
		}
	}

	mysqli_select_db($conn, $dbname);
	$stmt = $conn->prepare("SELECT id, email, last_login, last_ip FROM account WHERE username = ?");
	$stmt->bind_param("s", $_SESSION['username']);
	$stmt->execute();
	$stmt->bind_result($id, $email, $lastlogin, $lastip);
	$stmt->store_result();
	$stmt->fetch();
	if($stmt->num_rows > 0) {

		echo "<div class='card-header'>Account Information - ".$_SESSION['username']."</div>";
		echo "<div class='card-body'>";
		echo "<form action='../functions/upload.php' method='POST' enctype='multipart/form-data'>";
		echo "<img alt='avatar' src='../images/avatars/".getavatar($_SESSION['username'])."' class='media-object rounded-circle' style='width:80px; height:80px; padding:10px;'>";
		#echo "<input type='submit' value='Change Avatar' class='btn btn-success'>";
		echo('<div style="padding:0px 10px;"><input type="file" value="Pick Avatar" class="btn btn-primary" name="fileToUpload" id="fileToUpload">');
		echo('<input style="float:right;" type="submit" value="Upload Image" class="btn btn-success" name="submit"></div>');
		echo "</form>";
		echo "<form action='../functions/removeAvatarPic.php' method='POST'>";
		#echo('<div style="padding:1px 10px;"><input type="file" value="Pick Avatar" class="btn btn-primary" name="fileToUpload" id="fileToUpload">');
		echo('<div style="padding-bottom:40px; padding-right:10px;"><input style="float:right;" type="submit" value="Remove Image" class="btn btn-secondary" name="submit"></div>');
		echo "</form>";
		echo "<table class='table left-panel-table'>";
		echo "<tr>";
		echo "<td>Account Name</td>";
		echo "<td>Account Email</td>";
		echo "<td>Account Rank</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><strong>".$_SESSION['username']."</strong></td>";
		echo "<td><strong>$email</strong></td>";
		echo "<td><strong>".getgmlevel($id, 1)."</strong></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Ban Status</td>";
		echo "<td>Last IP</td>";
		echo "<td>GM Level</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><strong>".BanStatus($id)."</strong></td>";
		echo "<td><strong>$email</strong></td>";
		echo "<td><strong>".getgmlevel($id, 1)."</strong></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Last Login</td>";
		echo "<td>Last IP</td>";
		echo "<td>GM Level</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><strong>$lastlogin</strong></td>";
		echo "<td><strong>$lastip</strong></td>";
		echo "<td><strong>".getgmlevel($id, 0)."</strong></td>";
		echo "</tr>";
		echo "</table>";
		echo "<form action='../functions/logout.php' method='POST' autocomplete='off'>";
		echo "<input type='submit' value='Logout' class='btn btn-primary'>";
		if(getgmlevel($id, 0) > 2) {
			echo "<a class='btn btn-primary' style='float:right;' href='/acp'>Admin Panel</a>";
		}
		echo "</form>";
		echo "</div>";
	}else{
		echo "<div class='card-body'><div class='alert alert-danger'><strong>Warning!</strong> You are not logged in. You will be redirected.</div></div>";
		header("refresh:2; /login");
	}
	?>
  </div>
</div>
