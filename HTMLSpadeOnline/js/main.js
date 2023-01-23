function AccountRegister() {
	var User = $("#iUsername").val();
	var Email = $("#iEmail").val();
	var Pass = $("#iPassword").val();
	var PassVerify = $("#iVerifyPassword").val();
	var RegisterError = $("#registerError");
	var SuccessBox = $("#registerSuccess");
	
	if (User == ''|| Pass == '' || Email == '' || PassVerify == '') {
		RegisterError.html("Please fill out all fields.");
		RegisterError.fadeIn('fast');
	} else {
		$.ajax({
			type: "POST",
			data: { iUsername: User, iEmail: Email, iPassword: Pass, iVerifyPassword: PassVerify },
			url: "/Register/",
			success: function(response) {
				if(response == "ERROR#0") {
					if(RegisterError.is(":visible")) {
						if(RegisterError.text().length > 0)
							RegisterError.html("Please make sure your passwords do match");
						else
							RegisterError.effect("shake");
					} else {
						RegisterError.html("Please make sure your passwords do match");
						RegisterError.fadeIn('fast');
					}
				} else if(response == "ERROR#1") {		
					if(RegisterError.is(":visible")) {
						if(RegisterError.text().length > 0)
							RegisterError.html("Username is already used, please try different one.");
						else
							RegisterError.effect( "shake" );
					} else {
						RegisterError.html("Username is already used, please try different one.");
						RegisterError.fadeIn('fast');
					}
				} else if(response === "ERROR#2") {
					if(RegisterError.is(":visible")) {
						if(RegisterError.text().length > 0)
							RegisterError.html("Please use a correct email address.");
						else
							RegisterError.effect( "shake" );
					} else {
						RegisterError.html("Please use a correct email address.");
						RegisterError.fadeIn('fast');
					}
				} else if(response === "ERROR#3") {
					if(RegisterError.is(":visible")) {
						if(RegisterError.text().length > 0)
							RegisterError.html("Email is already used, please try different one.");
						else
							RegisterError.effect( "shake" );
					} else {
						RegisterError.html("Email is already used, please try different one.");
						RegisterError.fadeIn('fast');
					}
				} else if(response == "SUCCESS#1") {
					if(RegisterError.is(":visible"))
						RegisterError.fadeOut('fast');
					
					SuccessBox.html("Your account has been successfully created.");
					SuccessBox.fadeIn('fast');
				}
			}
		});
	}
}