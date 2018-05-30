<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/home"><?php echo $webtitle; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li><a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a></li>
        <li><a class="nav-link" href="#">Something</a></li>

      <?php
        if(isset($_SESSION['username'])) {
          if(getgmlevel($_SESSION['id'], 0) > 2) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            echo '  Control Panels';
            echo '</a>';
            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
            echo '  <a class="dropdown-item" href="/ucp">User Control Panel</a>';
            echo '  <div class="dropdown-divider"></div>';
            echo '  <a class="dropdown-item" href="/acp">Admin Control Panel</a>';
            echo '</div>';
            echo '</li>';
          } else {
            echo('<li><a class="nav-link" href="/ucp">User Control Panel</a></li>');
          }
          echo('<li><a class="nav-link" href="functions/logout.php">Logout</a></li>');
        }
       ?>
    </ul>
  </div>
</nav>
<div class="container" style="padding-top:100px;">
  <div class="row">
