<?php
  if(file_exists("install/install.php")) {
    header("refresh:0; /install");
  }elseif(isset($_GET['page'])) {
      $page = clearPageLink($_GET['page']);
      if(file_exists("pages/$page.php")) {
        include("pages/$page.php");
      } else {
        header("refresh:0; /404");
      }
  } else {
    include("pages/home.php");
  }
?>
