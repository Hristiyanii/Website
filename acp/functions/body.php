<?php
if(isset($_GET['page'])) {
      $page = $_GET['page'];
      if(file_exists("pages/$page.php")) {
        include("pages/$page.php");
      } else {
        header("refresh:0; ./404");
      }
  } else {
    include("pages/home.php");
  }
?>
