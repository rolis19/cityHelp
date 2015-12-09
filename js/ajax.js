function checkPass() {
	var pass = $('#inputcurpass').val();
	if(pass == "") {
		$('#inputcurpass').css('border', '2px #CCC solid');
	} else {
		$.ajax({
			type: "POST",
			url: "../ajax/password.php",
			data: "pass="+pass,
			cache: false,
			success: function(response) {
				if(response == 1) {
					$('#inputcurpass').css('border', '2px #2ecc71 solid');
					document.getElementById("inputcurpass").setCustomValidity("");
				} else {
					$('#inputcurpass').css('border', '2px #e74c3c solid');
					document.getElementById("inputcurpass").setCustomValidity("Please insert your current password");
				}
			}
		});
	}
}
