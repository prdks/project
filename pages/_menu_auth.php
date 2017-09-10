<ul class="nav navbar-top-links navbar-right">
    <?php
    $sql = "
    SELECT COUNT(reservation_id) as reservecout
    FROM reservation
    WHERE reservation_status = 0
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    $num_approve = $row['reservecout'];
    
        switch ($_SESSION['user_type']) {
          case 0:
          {
            if ($num_approve > 0)
            {
              ?>
              <li class="dropdown">
              <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
              &nbsp;&nbsp;&nbsp;<i class="fa fa-bell fa-fw"></i><span class="badge1" data-badge="<?php echo $num_approve?>"></span>&nbsp;&nbsp;&nbsp;
              </a>
              </li>
              <?php
            }
            else
            {
              ?>
              <li class="dropdown">
              <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
              &nbsp;&nbsp;&nbsp;<i class="fa fa-bell"></i><span></span>&nbsp;&nbsp;&nbsp;
              </a>
              </li>
              <?php
            }
          }
            break;
          case 4:
          {
            if ($num_approve > 0)
            {
              ?>
              <li class="dropdown">
               <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
               &nbsp;&nbsp;&nbsp;<i class="fa fa-bell fa-fw"></i><span class="badge1" data-badge="<?php echo $num_approve?>"></span>&nbsp;&nbsp;&nbsp;
              </a>
              </li>
              <?php
            }
            else
            {
              ?>
              <li class="dropdown">
               <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
               &nbsp;&nbsp;&nbsp;<i class="fa fa-bell"></i><span></span>&nbsp;&nbsp;&nbsp;
               </a>
              </li>
              <?php
            }
          }
            break;
            case 5:
            {
              $sql = "
              SELECT COUNT(reservation_id) as reservecout
              FROM reservation
              WHERE fist_approve_status = 0
              ";
              $result = $conn->query($sql);
              $row = $result->fetch_array();
              $num_approve = $row['reservecout'];

              if ($num_approve > 0)
              {
                ?>
                <li class="dropdown">
                 <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
                 &nbsp;&nbsp;&nbsp;<i class="fa fa-bell fa-fw"></i><span class="badge1" data-badge="<?php echo $num_approve?>"></span>&nbsp;&nbsp;&nbsp;
                </a>
                </li>
                <?php
              }
              else
              {
                ?>
                <li class="dropdown">
                 <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
                 &nbsp;&nbsp;&nbsp;<i class="fa fa-bell"></i><span></span>&nbsp;&nbsp;&nbsp;
                 </a>
                </li>
                <?php
              }
            }
              break;
              case 6:
              {
                $sql = "
                SELECT COUNT(reservation_id) as reservecout
                FROM reservation
                WHERE fist_approve_status = 0
                ";
                $result = $conn->query($sql);
                $row = $result->fetch_array();
                $num_approve = $row['reservecout'];
                if ($num_approve > 0)
                {
                  ?>
                  <li class="dropdown">
                   <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
                   &nbsp;&nbsp;&nbsp;<i class="fa fa-bell fa-fw"></i><span class="badge1" data-badge="<?php echo $num_approve?>"></span>&nbsp;&nbsp;&nbsp;
                  </a>
                  </li>
                  <?php
                }
                else
                {
                  ?>
                  <li class="dropdown">
                   <a href="reserve_approve.php" data-toggle="tooltip" data-placement="bottom" title="รายการรออนุมัติ">
                   &nbsp;&nbsp;&nbsp;<i class="fa fa-bell"></i><span></span>&nbsp;&nbsp;&nbsp;
                   </a>
                  </li>
                  <?php
                }
              }
                break;
        }
        ?>
      
    <li class="dropdown">
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
    </li>
</ul>
