<?php
$servername = "127.0.0.1";
$username = "root";
$password = "titkatabg123";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!";

$sql = "SELECT * FROM world.creature_template WHERE name LIKE '?';";
if (mysqli_query($conn, $sql)) {
   echo "<br>creature_template Found!";
 $last_id = mysqli_insert_id($conn);
 echo "<br>Last ID?: ". $last_id;
} else {
   echo "<br>Error selecting from creature_template: " . mysqli_error($conn);
}
?>
