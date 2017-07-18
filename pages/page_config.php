<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
<link href="../dist/css/configp.css" rel="stylesheet">
<script src="../dist/js/configp.js"></script>
</head>
<body id="enterkl">

<div class="container">
  <div class="row">
    <div id="setloginpage" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
      <form action="admin/insertconfig.php" method="post" class="form-horizontal">
        <div class="panel panel-primary">
          <div class="panel-heading">Config Application</div>
          <div class="panel-body">

            <?php include 'admin/formconfig.php'; ?>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
