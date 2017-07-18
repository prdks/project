
<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown  pull-right">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          ลงชื่อเข้าสู่ระบบ <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
              <form id="form_login" action="new_user/check.php"method="post">
              <a id="signin-button" onclick="handleSignInClick()" role="button">
                <i class="fa fa-google fa-fw"></i>ผู้ใช้งานทั่วไป
              </a>
              <input type="hidden" id="hd_email" name="hd_email" value="">
              <input type="hidden" id="name" name="name" value="">
              <input type="hidden" id="pqrcode" name="pqrcode" value="null">
              </form>
            </li>
            <li>
              <a href="admin_login.php" ><i class="fa fa-cog fa-fw"></i>Administrator</a>
            </li>

        </ul>
        <!-- /.dropdown-user -->
    </li>
</ul>


<!-- /.navbar-top-links -->
