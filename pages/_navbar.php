
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hidden-xs hidden-sm" href="index.php">
        <img src="viewimg.php?mode=logo" class="pull-left" width="50" height="50" style="padding-top:-15px; margin-top:-5px; margin-right:10px;">
        <center class="text-left">
        ระบบจองรถยนต์
        <?php if (isset($_SESSION['system_name'])): ?>
        <br>
          <?php echo $_SESSION['system_name']; ?>
        <?php endif; ?>
        </center>
        
      </a>
      <a class="navbar-brand hidden-lg hidden-md" href="index.php">
        <span style="font-size:15px;font-weight: bold;">
        <img src="viewimg.php?mode=logo" class="pull-left" width="30" height="30" style="padding-top:-15px; margin-top:-5px; margin-right:10px;">
         ระบบจองรถยนต์
        <?php if (isset($_SESSION['system_name'])): ?>
          <?php echo $_SESSION['system_name']; ?>
        <?php endif; ?>
        </span>
      </a>
  </div>

    <!-- /.navbar-header -->
    <?php
    if(!isset($_SESSION['loggedin'])){
      include '_menu_unauth.php';
    }
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      include '_menu_auth.php';
    }
    ?>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse" >
            <ul class="nav" id="side-menu">
            <?php
            if(!isset($_SESSION['loggedin']))
            {
             ?>
             <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
             <?php
            }
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
              include '_menu_user_levels.php';
            }
            ?>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>

  <div class="sidebartoggle">
    <span></span>
    <span></span>
    <span></span>
  </div>
