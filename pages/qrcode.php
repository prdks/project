<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/entkl.js"></script>
</head>
<body id="enterkl">


            <?php
            if(!isset($_SESSION['loggedin'])){
              // googleAuth.file
              include '_googleauth.php';
              ?>
              <div class="wrapper-enterkl">
              <span class="enterkl-content">
                  <h3>กรุณาเข้าสู่ระบบ</h3>
                  <form id="form_login" action="user/controller.php"method="post">
                    <center>
                      <button type="button" class="btn btn-lg btn-block btn-danger" id="signin-button" onclick="handleSignInClick()">
                        <i class="fa fa-google fa-fw"></i>เข้าสู่ระบบ
                      </button>
                    </center>
                    <input type="hidden" name="mode" value="LoginAuth">
                    <input type="hidden" id="hd_email" name="hd_email" value="">
                    <input type="hidden" id="name" name="name" value="">
                    <input type="hidden" id="pqrcode" name="pqrcode" value="<?php echo $_GET['id'];?>">
                  </form>
              </span>
              </div>
              <?php
            }
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
              if ($_SESSION['user_type'] == 3) 
              {
                include 'enterkl/form.php';
                ?>

                <center>
                  <a class="btn btn-danger" href="_logout.php?key=enterkl" ><i class="fa fa-sign-out fa-fw"></i>ออกจากระบบ</a>
                </center>

                <br>

                <?php
              }
              else 
              {
                echo "
                <!DOCTYPE html>
                <script>
                function redir()
                {
                window.location.assign('index.php');
                }
                </script>
                <body onload='redir();'></body>
                ";
              }
            }
            ?>

</body>
</html>
