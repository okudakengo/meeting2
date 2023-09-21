$(document).ready(function(){
	
	$('#btnHamburger').on('click', function(){
		if ($('#sidemenu').hasClass('open')){
			$('#sidemenu').removeClass('open'); 
		} else {
			$('#sidemenu').addClass('open');
		}
	});
	/*
	$('#btnHamburgerClose').on('click', function(){
		$('#HamburgerMenu').removeClass('open'); 
	});
	$('input[name="InvitationURL"]').on('focus', function(){
		$(this).select();
	});
	$('main').on('click', function(){
		if ($('#HamburgerMenu').hasClass('open')){
			$('#HamburgerMenu').removeClass('open'); 
		//} else {
			//preventDefault(); 
		}
	});
	*/
});
