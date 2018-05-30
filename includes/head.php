<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
    function ajax(id, file) {
      var req = new XMLHtt  pRequest();

      req.onreadystatechange = function() {
        if(req.readyState == 4 && req.status == 200) {
          document.getElementById(id).innerHTML =  req.responseText;
        }
      }

      req.open('GET', file, true);
      req.send();
    }
      setInterval(function(){ajax("portchecker", "../functions/portchecker.php")},1000);
    </script>
    <script>
    $(document).ready(function() {
      $('.myForm').submit(function (event) {
        var data = $(this);
        $.ajax({
          type: data.attr('method'),
          url: data.attr('action'),
          data: data.serialize(),
          success: function (data) {
            $('.output').html(data);
            $('.myForm input:NOT([type=submit])').val('');
            setTimeout(
              function(){
                $("#refresh_on_login").load(location.href + "#refresh_on_login");
              },
              1000);
          }
        });
        event.preventDefault();
      });
    });
    </script>
    <?php
    function clearPageLink($string) {
       $string = str_replace(' ', '-', $string);
       $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

       return preg_replace('/-+/', '-', $string);
    }
      $title_start = "";
      if(isset($_GET['page'])) {
        mysqli_select_db($conn, $webdbname);
        $stmt = $conn->prepare("SELECT name FROM page_names WHERE page = ?");
        $page = clearPageLink($_GET['page']);
        $stmt->bind_param("s", $page);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->store_result();
        if($stmt->num_rows > 0) {
          while($stmt->fetch()) {
            $title_start = $name." - ";
          }
        } else {
          $title_start = "UNKNOWN PAGE - ";
        }
      }
      echo('<title>'.$title_start.$webtitle."</title>")
    ?>
    <meta name="author" content="Hristiyan Ivanov">
    <meta name="description" content="Website built for <?php echo $webtitle;?>">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
  </head>
  <body id="refresh_on_login">
