$(document).ready(function(){
	$('#test-confirmation-btn').click(function(){
		var name=$('#bkng-name').text();
		var mob=$('#mobile-nmbr').text();
		var mail_id=$('#mail-id').text();
		var bkng_id=$('#bkng-id').text();

		console.log(name);
		console.log(mob);
		console.log(mail_id);
		console.log(bkng_id);
		$.ajax({
			url:"add_test_confirmation_details.php?name="+name+"&mob="+mob+"&mail_id="+mail_id+"&bkng_id="+bkng_id,
			success:function(data){
				
			}
		});
	});
});