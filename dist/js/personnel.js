function getPersonDetail(personnel_id) {
	$.ajax({
		url:"controllers/controller_personnel.php",
		type: "POST",
		data: {personnel_id:personnel_id,mode:'getPersonDetail'},
		success:function(result){
      $('#detail_modal_content').html(result);
      $('#Detail_modal').modal("data-backdrop='static'");
		}
	});
}
