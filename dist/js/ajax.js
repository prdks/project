$(document).ready(function() {
  //---------------- title ----------------
  $("#form_insert_title").submit(function(e) {
      e.preventDefault();
      insertTitle();
  });

  $("#form_edit_title").submit(function(e) {
      e.preventDefault();
      editTitle();
  });

  $("#form_delete_title").submit(function(e) {
      e.preventDefault();
      deleteTitle();
  });

  //---------------- position ----------------
  $("#form_insert_position").submit(function(e) {
      e.preventDefault();
      insertPosition();
  });

  $("#form_edit_position").submit(function(e) {
      e.preventDefault();
      editPosition();
  });

  $("#form_delete_position").submit(function(e) {
      e.preventDefault();
      deletePosition();
  });

  // ---------------- Department ----------------
  $("#form_insert_department").submit(function(e) {
      e.preventDefault();
      insertDepartment();
  });

  $("#form_edit_department").submit(function(e) {
      e.preventDefault();
      editDepartment();
  });

  $("#form_delete_department").submit(function(e) {
      e.preventDefault();
      deleteDepartment();
  });
    // ---------------- User_type ----------------
    $("#form_insert_usertype").submit(function(e) {
        e.preventDefault();
        insertUserType();
    });

    $("#form_edit_usertype").submit(function(e) {
        e.preventDefault();
        editUserType();
    });

    $("#form_delete_usertype").submit(function(e) {
        e.preventDefault();
        deleteUserType();
    });

    // ---------------- Brand ----------------
    $("#form_insert_brand").submit(function(e) {
        e.preventDefault();
        insertBrand();
    });

    $("#form_edit_brand").submit(function(e) {
        e.preventDefault();
        editBrand();
    });

    $("#form_delete_brand").submit(function(e) {
        e.preventDefault();
        deleteBrand();
    });
});

// ------------- title_name ---------------
function insertTitle() {
  var title = $('[name=title_name]').val();
    $.ajax({
      type: "POST",
      url: "title_name/controller.php",
      data: {title, mode: 'insertTitle'},
      dataType: 'json',
      success: function(data){
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "เพิ่มข้อมูลสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('title_name.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('title_name.php'); }
            );
        }
        else if (data.result === 'error')
        {
          swal({
                title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('title_name.php'); }
            );
        }
      }
    });
}

function editTitle() {
  var title = $('[name=txt_update]').val();
  var id = $('[name=update_id]').val();
  $.ajax({
    type: "POST",
    url: "title_name/controller.php",
    data: {title, id, mode: 'editTitle'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "แก้ไขข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
    }
  });
}

function deleteTitle() {
  var id = $('[name=delete_id]').val();
  $.ajax({
    type: "POST",
    url: "title_name/controller.php",
    data: {id, mode: 'deleteTitle'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "ลบข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('title_name.php'); }
          );
      }
    }
  });
}

// ------------- position ---------------
function insertPosition() {
  var position = $('[name=position_name]').val();
    $.ajax({
      type: "POST",
      url: "position/controller.php",
      data: {position, mode: 'insertPosition'},
      dataType: 'json',
      success: function(data){
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "เพิ่มข้อมูลสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('position.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('position.php'); }
            );
        }
        else if (data.result === 'error')
        {
          swal({
                title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('position.php'); }
            );
        }
      }
    });
}

function editPosition() {
  var position = $('[name=txt_update]').val();
  var id = $('[name=update_id]').val();
  $.ajax({
    type: "POST",
    url: "position/controller.php",
    data: {position, id, mode: 'editPosition'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "แก้ไขข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
    }
  });
}

function deletePosition() {
  var id = $('[name=delete_id]').val();
  $.ajax({
    type: "POST",
    url: "position/controller.php",
    data: {id, mode: 'deletePosition'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "ลบข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('position.php'); }
          );
      }
    }
  });
}

// ------------- department ---------------
function insertDepartment() {
  var department = $('[name=department_name]').val();
    $.ajax({
      type: "POST",
      url: "department/controller.php",
      data: {department, mode: 'insertDepartment'},
      dataType: 'json',
      success: function(data){
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "เพิ่มข้อมูลสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('department.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('department.php'); }
            );
        }
        else if (data.result === 'error')
        {
          swal({
                title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('department.php'); }
            );
        }
      }
    });
}

function editDepartment() {
  var department = $('[name=txt_update]').val();
  var id = $('[name=update_id]').val();
  $.ajax({
    type: "POST",
    url: "department/controller.php",
    data: {department, id, mode: 'editDepartment'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "แก้ไขข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
               showConfirmButton: false,
               timer: 2000,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
    }
  });
}

function deleteDepartment() {
  var id = $('[name=delete_id]').val();
  $.ajax({
    type: "POST",
    url: "department/controller.php",
    data: {id, mode: 'deleteDepartment'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "ลบข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('department.php'); }
          );
      }
    }
  });
}

// ------------- user_type ---------------
function insertUserType() {
  var user_type_name = $('[name=user_type_name]').val();
  var level = $('[name=level]').val();

    $.ajax({
      type: "POST",
      url: "user_type/controller.php",
      data: {user_type_name, level, mode: 'insertUserType'},
      dataType: 'json',
      success: function(data){
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "เพิ่มข้อมูลสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('user_type.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('user_type.php'); }
            );
        }
        else if (data.result === 'error')
        {
          swal({
                title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('user_type.php'); }
            );
        }
      }
    });
}

function editUserType() {
  var user_type = $('[name=txt_update]').val();
  var level = $('[name=txt_level]').val();
  var id = $('[name=update_id]').val();
  $.ajax({
    type: "POST",
    url: "user_type/controller.php",
    data: {user_type, level, id, mode: 'editUserType'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "แก้ไขข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
    }
  });
}

function deleteUserType() {
  var id = $('[name=delete_id]').val();
  $.ajax({
    type: "POST",
    url: "user_type/controller.php",
    data: {id, mode: 'deleteUserType'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "ลบข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('user_type.php'); }
          );
      }
    }
  });
}

// ------------- Brand ---------------
function insertBrand() {
  var car_brand = $('[name=car_brand_name]').val();
    $.ajax({
      type: "POST",
      url: "car_brand/controller.php",
      data: {car_brand, mode: 'insertBrand'},
      dataType: 'json',
      success: function(data){
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "เพิ่มข้อมูลสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('car_brand.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('car_brand.php'); }
            );
        }
        else if (data.result === 'error')
        {
          swal({
                title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              },
              function(){ window.location.assign('car_brand.php'); }
            );
        }
      }
    });
}

function editBrand() {
  var car_brand = $('[name=txt_update]').val();
  var id = $('[name=update_id]').val();
  $.ajax({
    type: "POST",
    url: "car_brand/controller.php",
    data: {car_brand, id, mode: 'editBrand'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "แก้ไขข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
    }
  });
}

function deleteBrand() {
  var id = $('[name=delete_id]').val();
  $.ajax({
    type: "POST",
    url: "car_brand/controller.php",
    data: {id, mode: 'deleteBrand'},
    dataType: 'json',
    success: function(data){
      if (data.result == 1) //สำเร็จ
      {
        swal({
              title: "ลบข้อมูลสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
      else if (data.result == 0) //ไม่สำเร็จ
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
               type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            },
            function(){ window.location.assign('car_brand.php'); }
          );
      }
    }
  });
}
