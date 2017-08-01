<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
</head>

<body>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">สรุปผลการประเมินการจองและใช้รถยนต์</h3>
                </div>
            </div>
            <a onclick="listsheet()">Authorize</a>

            <pre id="content"></pre>
        </div>

    </div>

</body>
</html>
