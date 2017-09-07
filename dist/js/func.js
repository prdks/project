
function sorting(json_object, key_to_sort_by) {
  function sortByKey(a, b) {
    var x = a[key_to_sort_by];
    var y = b[key_to_sort_by];
    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
  }
  json_object.sort(sortByKey);
}

function setBtnOnDetailForm() {
  var $active = $('.wizard .nav-tabs li.active');
  $active.next().removeClass('disabled');
  $active.removeClass('active');
  $active.addClass('success');
  $('#step1').removeClass('active');
  $('#step2').addClass('active');
  $active.next().addClass('active');
}

function setBtnOnSelectCarsForm() {
  var $active = $('.wizard .nav-tabs li.active');
  $active.next().removeClass('disabled');
  $active.removeClass('active');
  $active.addClass('success');
  $('#step2').removeClass('active');
  $('#step3').addClass('active');
  $active.next().addClass('active');
}

function setBtnOnInsertPassengerForm() {
  var $active = $('.wizard .nav-tabs li.active');
  $active.next().removeClass('disabled');
  $active.removeClass('active');
  $active.addClass('success');
  $('#step3').removeClass('active');
  $('#complete').addClass('active');
  $active.next().addClass('active');
}

function setBtnOnCompleteForm() {

}

function setDateStart() {
  var date_start = document.getElementById("date_start");
  var date_end = document.getElementById("date_end");
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

  date_start.min = today;
}

function resetWrongDate() {
  var date_start = document.getElementById("date_start");
  var date_end = document.getElementById("date_end");

  date_end.min = date_start.value;
  date_end.value = date_start.value;
}

function setDateEnd() {
  var date_start = document.getElementById("date_start").value;
  var date_end = document.getElementById("date_end");

  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

  if (date_start != '') date_end.min = date_start;
  else date_end.min = today;
}

function setWrongTime() {
  var start = document.getElementById('time_start');
  var end = document.getElementById('time_end');
  if (start.value == '') {
    end.defaultValue = '';
    start.focus();
  }
}

function setTimeEnd() {
  var start = document.getElementById('time_start').value;
  var end = document.getElementById('time_end');

  end.defaultValue =  start.substring(0,2)+":00";
  end.min = start.substring(0,2)+":00";
  end.max = "23:59";
}

function filterreservemalist() {
  var input, filter, table, tr, td ,td0,td2,td3,td4,td5, i;
  input = document.getElementById("masearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("reservation_ma_tablelist");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td0 = tr[i].getElementsByTagName("td")[0];
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];
    if (td0 || td || td2 || td3 || td4 || td5) {
      if (td.innerHTML.indexOf(filter) > -1 || td2.innerHTML.indexOf(filter) > -1) tr[i].style.display = "";
      else tr[i].style.display = "none";
    }
  }
}

function filterlist() {
  var input, filter, table, tr, td,td0,td2,td3,td4,td5, i;
  input = document.getElementById("listsearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("reservation_tablelist");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td0 = tr[i].getElementsByTagName("td")[0];
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    td5 = tr[i].getElementsByTagName("td")[5];
    if (td0 || td || td2 || td3 || td4 || td5) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
      else tr[i].style.display = "none";
    }
  }
}

function filtertable() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("TablePersonnelList");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    if (td || td2) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
      else tr[i].style.display = "none";
    }
  }
}

function filtertable2() { //in edit passenger (ADD)
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input2");
  filter = input.value.toUpperCase();
  table = document.getElementById("PersonnelTableSelect");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    if (td || td2) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
      else tr[i].style.display = "none";
    }
  }
}

function filtertable3() { //in edit passenger (Edit)
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input3");
  filter = input.value.toUpperCase();
  table = document.getElementById("PersonnelTableEdit");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    if (td || td2) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
      else tr[i].style.display = "none";
    }
  }
}

function DeletePassenger(btn) {
  var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
  var rowCount = table.rows.length;
  var row = btn.parentNode.parentNode.parentNode;

  if (rowCount == 1) {
    row.parentNode.removeChild(row);
    $('#Table_Passenger').hide();
    $('#EmptyPassenger').show();
  }else {
    row.parentNode.removeChild(row);
  }
  refreshPersonformDB();
}

function refreshPersonformDB() {
  $("#tbody_sPersonnel").empty();

  var PassengerTable = document.getElementById("PassengerListTable");
  var rowLength = PassengerTable.rows.length;
  var PassengerData = [];
  for (i = 1; i < rowLength; i++){
     var PassengerCells = PassengerTable.rows.item(i).cells;
     var cellLength = PassengerCells.length;
     for(var j = 1; j < cellLength; j++){
       if (j==1) var Name = PassengerCells.item(j).innerHTML;
     }
    var p_name = Name.substr(Name.indexOf(' ')+1);
    PassengerData.push({'Name' : p_name });
  }

  $.ajax({
    type: "POST",
    url: "reservation/controller.php",
    data: {user_name : $('#person_username').val()
      , passenger_name : PassengerData
      , mode: 'getPersonnel_For_AddPassenger'},
    dataType: 'json',
    success: function(data){
      // console.log(data);
      if (data[0].id)
      {
        var trHTML = '';
          $.each(data, function (i) {
              trHTML += '<tr>';
              trHTML += '<td><center>';
              trHTML += '<button type="button" class="btn btn-primary btn-xs" name="btn[]" value="'+ data[i].id +'">เพิ่ม</button>';
              trHTML += '</center></td>';
              trHTML += '<td>' + data[i].title +' '+ data[i].name + '</td>';
              trHTML += '<td>' + data[i].department + '</td>';
              trHTML += '</tr>';
          });
      }
      else
      {
        trHTML += '<tr><td colspan=3>ไม่พบข้อมูลบุคลากร</td></tr>';
      }
      $('#tbody_sPersonnel').append(trHTML);
    }
  });
}

function getReservationData() {
  // ค่าในฟอร์มทั้งหมด
  var data = $('#formdetail').serializeArray();
  // ค่าจากการเลือกรถยนต์
  $("input[id='selecter_cars']:checked").each(function ()
  {
    data.push({name : 'Car_id' , value : $(this).val() });
  });

  // เก็บข้อมูลจากตารางผู้โดยสาร
  var PassengerTable = document.getElementById("PassengerListTable");
  var rowLength = PassengerTable.rows.length;
  for (i = 1; i < rowLength; i++){
     var PassengerCells = PassengerTable.rows.item(i).cells;
     var cellLength = PassengerCells.length;
     for(var j = 1; j < cellLength; j++){
       if (j==1) var Name = PassengerCells.item(j).innerHTML;
       else if (j==2) var Department = PassengerCells.item(j).innerHTML;
     }
    data.push({name : 'passenger_name[]' , value : Name});
    data.push({name : 'passenger_department[]' , value : Department});
  }

  data.push({name : 'mode' , value : 'getDetail_For_Submit'});

    $.ajax({
      type: "POST",
      url: "reservation/controller.php",
      data: data,
      dataType: 'json',
      success: function(data){

        $('#show-user').html(data.user);
        $('#show-position').html(data.position);
        $('#show-department').html(data.department);
        $('#show-detail').html(data.detail);
        $('#show-date').html(data.date);
        $('#show-time').html(data.time);
        $('#show-cars').html(data.cars);
        $('#show-location').html(data.location);
        $('#show-appointment').html(data.appointment);
        $('#show-passenger').html(data.passenger);
        console.log(data.passenger);
      }
    });
}
