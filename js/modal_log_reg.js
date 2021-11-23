$(document).ready(function(){

	$('#admin_reg_btn').click(function(){
		$('#adminLoginModal').modal('hide');
		$('#adminRegisterModal').modal('show');
	});
	$('#admin_login_btn').click(function(){
		$('#adminRegisterModal').modal('hide');
		$('#adminLoginModal').modal('show');
	});


	$('#doctor_reg_btn').click(function(){
		$('#doctorLoginModal').modal('hide');
		$('#doctorRegisterModal').modal('show');
	});
	$('#doctor_login_btn').click(function(){
		$('#doctorRegisterModal').modal('hide');
		$('#doctorLoginModal').modal('show');
	});


    $('#patient_login_btn').click(function(){
        $('#patientRegisterModal').modal('hide');
        $('#patientLoginModal').modal('show');
    });
    $('#patient_reg_btn').click(function(){
        $('#patientLoginModal').modal('hide');
        $('#patientRegisterModal').modal('show');
    });
});