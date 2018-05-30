<div class="col-md-6">
  <div class="card">
    <?php
    if(isset($_SESSION['username'])) {
      header("refresh:0; /ucp");
    }
    loadSession("Account Details", "Log In To Your Account", "User", "Rank", "Silver Coins", "Gold Coins");
    ?>
  </div>
</div>
