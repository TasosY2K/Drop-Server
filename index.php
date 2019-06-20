<!--
  ________                                  _________
  \______ \_______  ____ ______            /   _____/ ______________  __ ___________
   |    |  \_  __ \/  _ \\____ \   ______  \_____  \_/ __ \_  __ \  \/ // __ \_  __ \
   |    `   \  | \(  <_> )  |_> > /_____/  /        \  ___/|  | \/\   /\  ___/|  | \/
  /_______  /__|   \____/|   __/          /_______  /\___  >__|    \_/  \___  >__|
          \/             |__|                     \/     \/                 \/
                                                            v1.4 by L34ND3V
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Public File Drop</title>
    <meta name="author" content="L34ND3V">
    <meta name="description" content="A small PHP based drop server.">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
  </head>
  <body>
    <script>
      function showname() {
        var name = document.forms['form']['uploaded_file'].files[0].name;
        document.getElementById('label').innerHTML = name;
      };
    </script>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Public Drop Server</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <form enctype="multipart/form-data" method="POST" name="form">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="uploaded_file" onchange="showname()">
                <label id="label" class="custom-file-label">Choose file</label>
              </div>
              <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">Drop it</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
        <?php
          if (!empty($_FILES['uploaded_file'])) {
            $ext = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);
            $path = "uploads/";
            $path = $path . basename( $_FILES['uploaded_file']['name']);
            if ($ext === "php" or $ext === "html") {
              echo '<p class="text-danger">This file extension is not allowed</p>';
            } elseif (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
              echo '<p class="text-success">The file<strong> '.  basename( $_FILES['uploaded_file']['name']).' </strong>has been uploaded</p>';
            } else {
              echo '<p class="text-danger">There was an error uploading the file, please try again!</p>';
            }
          } else {
            echo '<p class="text-success">Connection from <strong>'.$_SERVER['REMOTE_ADDR'],'</strong></p>';
          }
        ?>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3>File list</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul>
            <?php
              $files = preg_grep('/^([^.])/', scandir('uploads/'));
              sort($files);
              foreach ($files as $file) {
                echo'<li><a href="uploads/'.$file.'" download>'.$file.'</a></li>';
              }
             ?>
           </ul>
        </div>
      </div>
    </div>
  </body>
</html>
