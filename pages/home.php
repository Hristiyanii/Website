<div class="col-md-6">
  <div class="card">
    <div class="card-header">News</div>
    <div class="card-block">

      <?php
      mysqli_select_db($conn, $webdbname);
      $stmt = $conn->prepare("SELECT title, content, author, post_date FROM news ORDER BY post_date DESC LIMIT 5;");
      $stmt->execute();
      $stmt->bind_result($title, $content, $author, $postdate);
      $stmt->store_result();
      if($stmt->num_rows > 0) {
        while($stmt->fetch()) {
          echo "<div class='media'>";
          echo "<div class='media-left'>";
          echo "<img alt='avatar' src='../images/avatars/".getavatar($author)."' class='media-object rounded-circle' style='width:80px; height:80px; padding:10px;'>";
          echo "</div>";
          echo "<div class='media-body'>";
          echo "<h4 class='media-heading' style='padding:5px;'>".ucfirst($title)." <small style='padding:5px;font-size:12px;text-align:right;float:right;line-height:15px;'><i>Posted on ".date("F j, Y", $postdate)."</i></small><br><small style='padding:5px;font-size:14px;text-align:right;float:right;line-height:15px;'><i>By ".ucfirst($author)."</i></small></h4>";
          echo "<p>$content</p>";
          echo "</div>";
          echo "</div>";
        }
      }
      ?>

    </div>
  </div>
</div>
