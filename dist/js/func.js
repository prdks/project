
function sorting(json_object, key_to_sort_by) {
  function sortByKey(a, b) {
    var x = a[key_to_sort_by];
    var y = b[key_to_sort_by];
    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
  }
  json_object.sort(sortByKey);
}


function getProvince() {
  $.getJSON("_province.json", function(result){
    var province_group = result.th.changwats;
    sorting(province_group, 'name');
        $.each(province_group, function(i, field){
          $('#province').append($('<option>').text(field.name).attr('value', field.name));
          $('#display-province').append($('<option>').text(field.name).attr('value', field.name));
        });
  });
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

function DeleteLocation(btn) {
  var table = document.getElementById("LocationListTable").getElementsByTagName("tbody")[0];
  var rowCount = table.rows.length;
  var row = btn.parentNode.parentNode.parentNode;

  if (rowCount == 1) {
    row.parentNode.removeChild(row);
    $('#Table_Loaction').hide();
    $('#EmptyLocation').show();
  }else {
    row.parentNode.removeChild(row);
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
}

function getReservationData() {
  // ค่าในฟอร์มทั้งหมด
  var data = $('#formdetail').serializeArray();
  // ค่าจากการเลือกรถยนต์
  var checked = [];
  $("input[id='selecter_cars']:checked").each(function ()
  {
    checked.push({ 'Car_id' : $(this).val()});
  });

  // เก็บข้อมูลจากตารางผู้โดยสาร
  var PassengerTable = document.getElementById("PassengerListTable");
  var rowLength = PassengerTable.rows.length;
  var PassengerData = [];
  for (i = 1; i < rowLength; i++){
     var PassengerCells = PassengerTable.rows.item(i).cells;
     var cellLength = PassengerCells.length;
     for(var j = 1; j < cellLength; j++){
       if (j==1) var Name = PassengerCells.item(j).innerHTML;
       else if (j==2) var Department = jQuery(PassengerCells.item(j).innerHTML).text();
     }
    PassengerData.push({'Name' : Name , 'Department': Department});
  }

    $.ajax({
      type: "POST",
      url: "reservation/controller.php",
      data: {data , checked, PassengerData, mode: 'getDetail_For_Submit'},
      dataType: 'json',
      success: function(data){

        $('#show-user').html(data.user);
        $('#show-position').html(data.position);
        $('#show-department').html(data.department);
        $('#show-detail').html(data.detail);
        $('#show-fistdate').html(data.fistdate);
        $('#show-lastdate').html(data.lastdate);
        $('#show-time').html(data.time);
        $('#show-cars').html(data.cars);
        $('#show-location').html(data.location);
        $('#show-appointment').html(data.appointment);
        //passenger
        var passenger_str = "";
        $.each( data.passenger, function( index, value )
        {
            passenger_str += value
        });
        $('#show-passenger').html(passenger_str);

        //location
        // var location_str = "";
        // $.each( data.location, function( index, value )
        // {
        //     location_str += value
        // });
        // $('#show-location').html(location_str);

      }
    });
}

function sendDatatoGetCars() {
  $.ajax({
    type: "POST",
    url: "reservation/controller.php",
    data: {user_department : $('#user_department').val()
      ,date_start : $('#date_start').val()
      ,date_end : $('#date_end').val()
      ,time_start : $('#time_start').val()
      ,time_end : $('#time_end').val()
      , mode: 'getCars_For_Select'},
    success: function(data){
      $('#tbody_cars').html(data);
    }
  });
}


function insertReservation() {
  // ค่าจากการเลือกรถยนต์
  var checked = [];
  $("input[id='selecter_cars']:checked").each(function ()
  {
    checked.push({ 'Car_id' : $(this).val()});
  });

  //เก็บข้อมูลจากตารางสถานที่
  var LocationTable = document.getElementById("LocationListTable");
  var rowLength = LocationTable.rows.length;
  var LocationData = [];
  for (i = 1; i < rowLength; i++){
     var LocationCells = LocationTable.rows.item(i).cells;
     var cellLength = LocationCells.length;
     for(var j = 1; j < cellLength; j++){
       if (j==1) var LocationName = LocationCells.item(j).innerHTML;
       else if (j==2) var ProvinceName = LocationCells.item(j).innerHTML;
     }
    LocationData.push({'LocationName' : LocationName ,'Province' : ProvinceName});
  }

  // เก็บข้อมูลจากตารางผู้โดยสาร
  var PassengerTable = document.getElementById("PassengerListTable");
  var rowLength = PassengerTable.rows.length;
  var PassengerData = [];
  for (i = 1; i < rowLength; i++){
     var PassengerCells = PassengerTable.rows.item(i).cells;
     var cellLength = PassengerCells.length;
     for(var j = 1; j < cellLength; j++){
       if (j==1) var Name = PassengerCells.item(j).innerHTML;
       else if (j==2) var Department = jQuery(PassengerCells.item(j).innerHTML).text();
     }
    PassengerData.push({'Name' : Name , 'Department': Department});
  }

  $.post("reservation/reserve_form/insert.php"
  ,{ require_detail : $('#detail').val()
  , date_start : $('#date_start').val()
  , date_end : $('#date_end').val()
  , time_start : $('#time_start').val()
  , time_end : $('#time_end').val()
  , checked , LocationData , PassengerData
  });
}
