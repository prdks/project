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
                title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม่",
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

  

});