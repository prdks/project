<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown  pull-right">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <?php echo $_SESSION['user_name']; ?> <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
              <a href="user_list.php"><i class="fa fa-list-alt fa-fw"></i> รายการจองรถยนต์ส่วนตัว</a>
            </li>
            <li>
              <a href="profile.php"><i class="fa fa-user fa-fw"></i> ข้อมูลส่วนตัว</a>
            </li>
            <li class="divider"></li>
            <li>
              <a id="signout-button" href="_logout.php" onclick="handleSignOutClick()"><i class="fa fa-sign-out fa-fw"></i>ออกจากระบบ</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->

    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
