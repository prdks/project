<?php
// Set your timezone!!
date_default_timezone_set('Asia/Bangkok');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym,"-01");
if ($timestamp === false) {
    $timestamp = time();
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y - m ', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td class="calendar-date"></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym.'-'.$day;

    if ($today == $date) {
        $week .= '<td class="calendar-date calendar-today">'.$day;
    } else {
        $week .= '<td class="calendar-date">'.$day;
    }
    $week .= '</td>';

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td class="calendar-date"></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>'.$week.'</tr>';

        // Prepare for new week
        $week = '';

    }

}

?>


<br>

<div class="panel panel-primary">
  <div class="panel-heading">
		<a href="?ym=<?php echo $prev; ?>">&lt;</a>
		<?php echo $html_title; ?>
		<a href="?ym=<?php echo $next; ?>">&gt;</a>
  </div>
  <div class="table-responsive">
  <table id="table-calendar" class="table table-bordered">
      <tr>
          <th class="calendar-days">อาทิตย์</th>
          <th class="calendar-days">จันทร์</th>
          <th class="calendar-days">อังคาร</th>
          <th class="calendar-days">พุธ</th>
          <th class="calendar-days">พฤหัส</th>
          <th class="calendar-days">ศุกร์</th>
          <th class="calendar-days">เสาร์</th>
      </tr>
      <?php
          foreach ($weeks as $week) {
              echo $week;
          }
      ?>
  </table>
  </div>
</div>
