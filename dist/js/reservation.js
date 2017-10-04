$(document).ready(function() {
    // ปุ่มเพิ่มสถานที่
    var max_fields = 10; //maximum input boxes allowed
    var x = 1; //initlal text box count
    $('#addfield_location').click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            var str = '<div class="form-group">';
            str += '<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"></label>';
            str += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-9">';
            str += '<input type="text" class="form-control" name="location[]" placeholder="พิมพ์ชื่อสถานที่ต้องการไป (เพิ่มเติม)">';
            str += '</div><div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><a href="#" class="btn btn-danger remove_field">ลบ</a></div></div></div>';
            $('.location_field').append(str);
        }
    });

    $('.location_field').on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        x--;
    });


    // ถ้ากดเลือกวันจองวันแรก
    $('#date_start').click(function() {
        setDateStart();
    });
    // รีเซ็ตหากเลือกวันที่ไม่ถูกต้อง
    $('#date_start').on("change", function() {
        if ($('#date_end').val() != '') {
            resetWrongDate();
        }
    });
    // ถ้ากดเลือกวันจองวันสุดท้าย
    $('#date_end').click(function() {
        setDateEnd();
    });

    // ถ้าเลือกเวลาสิ้นสุดแต่ยังไม่เลือกเวลาเริ่มต้น
    $('#time_end').click(function() {
        if ($('#time_start').val() == '') {
            setWrongTime()
        } else {
            setTimeEnd();
        }
    });


    $(".selecter_cars").click(function() { // เมื่อคลิก checkbox  ใดๆ
        if ($(this).prop("checked") == true) { // ตรวจสอบ property  การ ของ
            var indexObj = $(this).index(".selecter_cars"); //
            $(".selecter_cars").not(":eq(" + indexObj + ")").prop("checked", false); // ยกเลิกการคลิก รายการอื่น
        }
    });

    $('#getPersonFromDB').hide();
    $('#InsertPerson').hide();

    // เลือกเพิ่มผู้โดยสาร
    $("input[name='select_mode']").click(function() { // เมื่อคลิก checkbox  ใดๆ
        if ($(this).prop("checked") == true) { // ตรวจสอบ property  การ ของ
            var indexObj = $(this).index("input[name='select_mode']"); //
            $("input[name='select_mode']").not(":eq(" + indexObj + ")").prop("checked", false); // ยกเลิกการคลิก รายการอื่น
            if ($(this).val() == 1) {
                refreshPersonformDB();

                $('#getPersonFromDB').show();
                $('#InsertPerson').hide();
            } else if ($(this).val() == 2) {
                $('#getPersonFromDB').hide();
                $('#InsertPerson').show();
            }
        }
    });

    // ถ้าตาราง ผู้โดยสาร่ยังไม่มีข้อมูล
    var tbody_sPassenger = $("#PassengerListTable tbody");
    if (tbody_sPassenger.children().length == 0) {
        $('#Table_Passenger').hide();
        $('#EmptyPassenger').show();
    }

    //ถ้ากดปุ่มเพิ่มผู้โดยสารจากตาราง
    $("#TablePersonnelList").delegate("button", "click", function(e) {
        var table = document.getElementById("TablePersonnelList").getElementsByTagName("tbody")[0];
        e = e || window.event;
        var data = [];
        var target = e.srcElement || e.target;

        // ลบแถวที่คลิก
        var rowCount = table.rows.length;
        var row = target.parentNode.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // ดึงข้อมูลจากแถว
        while (target && target.nodeName !== "TR") {
            target = target.parentNode;
        }
        if (target) {
            var cells = target.getElementsByTagName("td");
            for (var i = 0; i < cells.length; i++) {
                data.push(cells[i].innerHTML);
            }
        }

        $('#EmptyPassenger').hide();
        $('#Table_Passenger').show();
        var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        $.each(data, function(index, value) {
            if (index == 0) {
                row.insertCell(index).innerHTML = "<center><button type='button' class='btn btn-danger btn-xs' onclick='DeletePassenger(this)' name='btn[]'>ลบ</button></center>";
            } else if (index == 1) {
                row.insertCell(index).innerHTML = value;
            } else {
                row.insertCell(index).innerHTML = value; //department
            }
        });

    });

    // เมื่อกดปุ่มเพิ่มชื่อผู้้โดยสารกำหนดเอง
    $('#insertPassengerList').click(function(event) {
        var title = $('#select_title_name').val();
        var name = $('#person_name').val();
        var department = $('#select_department').val();

        if (name != '' && name.length != 0) {
            if ($.trim(name) == '') { //ถ้าใส่แต่ whitespace
                $('#person_name').val('');
                $('#person_name').attr('required', true);
            } else {
                $('#EmptyPassenger').hide();
                $('#Table_Passenger').show();
                var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = "<center><button type='button' class='btn btn-danger btn-xs' onclick='DeletePassenger(this)' name='btn[]'>ลบ</button></center>";
                cell2.innerHTML = title + ' ' + name;
                cell3.innerHTML = department;
                $('#person_name').val('');
                $('#select_title_name')[0].selectedIndex = 0;
                $('#select_department')[0].selectedIndex = 0;
                $('#person_name').focus();
                $('#person_name').attr('required', false);
                event.preventDefault();
            }
        } else {
            $('#person_name').attr('required', true);
        }
    });
    // --------------------------tab---------------------------
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });


    $(".next-step").click(function(e) {
        var id = $(this).attr("id");
        switch (id) {
            case 'btnDetail':
                if ($('#formdetail').valid()) {
                    $.ajax({
                        type: "POST",
                        url: "reservation/controller.php",
                        data: {
                            user_department: $('#user_department').val(),
                            date_start: $('#date_start').val(),
                            date_end: $('#date_end').val(),
                            time_start: $('#time_start').val(),
                            time_end: $('#time_end').val(),
                            mode: 'getCars_For_Select'
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data[0].id) {
                                var trHTML = '';
                                $.each(data, function(i) {
                                    trHTML += '<tr>';
                                    trHTML += '<td><center>';
                                    trHTML += '<input type="radio" id="selecter_cars" name="selecter_cars" class="selecter_cars" value="' + data[i].id + '" data-seat="' + data[i].seat + '">';
                                    trHTML += '</center></td>';
                                    trHTML += '<td class="text-center">' + data[i].reg + '</td>';
                                    trHTML += '<td>' + data[i].brand + '</td>';
                                    trHTML += '<td>' + data[i].kind + '</td>';
                                    trHTML += '<td class="text-center">' + data[i].seat + '</td>';
                                    trHTML += '<td>' + data[i].driver + '</td>';
                                    trHTML += '<td>' + data[i].department + '</td>';
                                    trHTML += '</tr>';
                                });
                            } else {
                                trHTML += '<tr><td colspan="7" class="text-center">ไม่พบข้อมูลรถยนต์ว่าง</td></tr>';
                                swal({
                                        title: "ไม่พบข้อมูลรถยนต์ว่าง",
                                        text: "ต้องการเปลี่ยนวันและเวลาที่จองใช้ใหม่หรือไม่",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ใช่, ต้องการเปลี่ยน",
                                        showLoaderOnConfirm: true,
                                        closeOnConfirm: false,
                                        html: true,
                                        cancelButtonText: "ยกเลิกรายการ"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            setTimeout(function() {
                                                var $active = $('.wizard .nav-tabs li.active');
                                                $active.removeClass('success');
                                                $active.removeClass('active')

                                                $('#step2').removeClass('active');
                                                $('#step1').addClass('active');
                                                $active.prev().removeClass('success');
                                                $active.prev().addClass('active');
                                                $("#tbody_cars").empty();
                                                swal.close();
                                            }, 2000);
                                        } else {
                                            window.location.assign('index.php');
                                        }
                                    });
                            }
                            $('#tbody_cars').append(trHTML);
                        }
                    });
                    setBtnOnDetailForm();
                }
                break;
            case 'btnSelectCars':
                if (!$("input[id='selecter_cars']:checked").val()) {
                    swal({
                        title: 'กรุณาเลือกรถยนต์',
                        type: "warning",
                        confirmButtonText: "ตกลง",
                    });
                } else {
                    setBtnOnSelectCarsForm();
                }
                break;
            case 'btnInsertPassenger':
                getReservationData();
                setBtnOnInsertPassengerForm();
                break;
        }
    });

    $(".prev-step").click(function() {
        var id = $(this).attr("id");
        switch (id) {
            case 'btnSelectCars':
                var $active = $('.wizard .nav-tabs li.active');
                $active.removeClass('success');
                $active.removeClass('active')

                $('#step2').removeClass('active');
                $('#step1').addClass('active');
                $active.prev().removeClass('success');
                $active.prev().addClass('active');
                $("#tbody_cars").empty();
                break;
            case 'btnInsertLocation':
                var $active = $('.wizard .nav-tabs li.active');
                $active.removeClass('success');
                $active.removeClass('active');

                $('#step3').removeClass('active');
                $('#step2').addClass('active');
                $active.prev().removeClass('success');
                $active.prev().addClass('active');
                break;
            case 'btnInsertPassenger':
                var $active = $('.wizard .nav-tabs li.active');
                $active.removeClass('success');
                $active.removeClass('active');

                $('#step3').removeClass('active');
                $('#step2').addClass('active');
                $active.prev().removeClass('success');
                $active.prev().addClass('active');
                break;
            case 'btnComplet':
                var $active = $('.wizard .nav-tabs li.active');
                $active.removeClass('success');
                $active.removeClass('active');

                $('#complete').removeClass('active');
                $('#step3').addClass('active');
                $active.prev().removeClass('success');
                $active.prev().addClass('active');
                break;
        }
    });

    $("#Insert_Reservation_Form").submit(function(e) {
        e.preventDefault();
        insertReservation();
    });

    function insertReservation() {
        // ค่าในฟอร์มทั้งหมด
        var data = $('#formdetail').serializeArray();
        // ค่าจากการเลือกรถยนต์
        $("input[id='selecter_cars']:checked").each(function() {
            data.push({ name: 'Car_id', value: $(this).val() });
        });

        // เก็บข้อมูลจากตารางผู้โดยสาร
        var PassengerTable = document.getElementById("PassengerListTable");
        var rowLength = PassengerTable.rows.length;
        for (i = 1; i < rowLength; i++) {
            var PassengerCells = PassengerTable.rows.item(i).cells;
            var cellLength = PassengerCells.length;
            for (var j = 1; j < cellLength; j++) {
                if (j == 1) var Name = PassengerCells.item(j).innerHTML;
                else if (j == 2) var Department = PassengerCells.item(j).innerHTML;
            }
            data.push({ name: 'passenger_name[]', value: Name });
            data.push({ name: 'passenger_department[]', value: Department });
        }

        data.push({ name: 'mode', value: 'insertReservation' });

        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //insert สำเร็จ
                {
                    swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('user_list.php'); }
                    );
                } else if (data.result == 0) //insert ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('index.php'); }
                    );
                }
            },
            error: function(jqXHR, exception) {
                console.log(jqXHR);
                // Your error handling logic here..
            }
        });

    }
    
});

// FUNCTION
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


function setDateStart() {
    var date_start = document.getElementById("date_start");
    var date_end = document.getElementById("date_end");
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);

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
    var today = now.getFullYear() + "-" + (month) + "-" + (day);

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

    end.defaultValue = start.substring(0, 2) + ":00";
    end.min = start.substring(0, 2) + ":00";
    end.max = "23:59";
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

function DeletePassenger(btn) {
    var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
    var rowCount = table.rows.length;
    var row = btn.parentNode.parentNode.parentNode;

    if (rowCount == 1) {
        row.parentNode.removeChild(row);
        $('#Table_Passenger').hide();
        $('#EmptyPassenger').show();
    } else {
        row.parentNode.removeChild(row);
    }
    refreshPersonformDB();
}

function refreshPersonformDB() {
    $("#tbody_sPersonnel").empty();

    var PassengerTable = document.getElementById("PassengerListTable");
    var rowLength = PassengerTable.rows.length;
    var PassengerData = [];
    for (i = 1; i < rowLength; i++) {
        var PassengerCells = PassengerTable.rows.item(i).cells;
        var cellLength = PassengerCells.length;
        for (var j = 1; j < cellLength; j++) {
            if (j == 1) var Name = PassengerCells.item(j).innerHTML;
        }
        var p_name = Name.substr(Name.indexOf(' ') + 1);
        PassengerData.push({ 'Name': p_name });
    }

    $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {
            user_name: $('#person_username').val(),
            passenger_name: PassengerData,
            mode: 'getPersonnel_For_AddPassenger'
        },
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            if (data[0].id) {
                var trHTML = '';
                $.each(data, function(i) {
                    trHTML += '<tr>';
                    trHTML += '<td><center>';
                    trHTML += '<button type="button" class="btn btn-primary btn-xs" name="btn[]" value="' + data[i].id + '">เพิ่ม</button>';
                    trHTML += '</center></td>';
                    trHTML += '<td>' + data[i].title + ' ' + data[i].name + '</td>';
                    trHTML += '<td>' + data[i].department + '</td>';
                    trHTML += '</tr>';
                });
            } else {
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
    $("input[id='selecter_cars']:checked").each(function() {
        data.push({ name: 'Car_id', value: $(this).val() });
    });

    // เก็บข้อมูลจากตารางผู้โดยสาร
    var PassengerTable = document.getElementById("PassengerListTable");
    var rowLength = PassengerTable.rows.length;
    for (i = 1; i < rowLength; i++) {
        var PassengerCells = PassengerTable.rows.item(i).cells;
        var cellLength = PassengerCells.length;
        for (var j = 1; j < cellLength; j++) {
            if (j == 1) var Name = PassengerCells.item(j).innerHTML;
            else if (j == 2) var Department = PassengerCells.item(j).innerHTML;
        }
        data.push({ name: 'passenger_name[]', value: Name });
        data.push({ name: 'passenger_department[]', value: Department });
    }

    data.push({ name: 'mode', value: 'getDetail_For_Submit' });

    $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: data,
        dataType: 'json',
        success: function(data) {

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
        }
    });
}