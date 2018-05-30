<div class="col-md-6">
  <div class="card">
    <div class="card-header">Registration Panel</div>
    <div class="card-body">
      <?php
        if (isset($_SESSION['username'])) {
          echo "<div class='alert alert-danger'><strong>Warning!</strong> You are already logged.</div>";
          header("refresh:1; /ucp");
        } else {
          echo '      <div class="output"></div> <!-- container to post the output from php file -->
                <form action="functions/register.php" method="POST" autocomplete="off" class="myForm">
                  <div class="form-group">
                    <label for="user">Username:</label>
                    <input type="text" class="form-control" id="user" name="user">
                  </div>
                  <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="pass" class="form-control" autocomplete="new-password">
                  </div>
                  <div class="form-group">
                    <label for="pass2">Confirm Password:</label>
                    <input type="password" name="pass2" id="pass2" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exp">Expansion:</label>
                    <select name="exp" id="exp" class="form-control">
                      <option value="0" selected hidden disabled></option>
                      <!--<option value="0">Vanilla</option>
                      <option value="1">TBC</option>-->
                      <option value="2">Wrath of The Lich King</option>
                    </select>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Register">
                </form>';
        }
       ?>


    </div>
  </div>
</div>
