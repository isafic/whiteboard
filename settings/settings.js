var lang;
var settingsPhp = "../settings/settings.php";
function changeLang() {
	var lang = $("#lang").val();
	$.post(settingsPhp, { lang: lang, uninstall: "false"});
	location.reload();
	console.log('language chang incoming');
}

function submitSettings() {
	var lang = $("#lang").val();
	var uninstall = $("#uninstall").is(':checked');
	

	$.post("settings.php", { lang: lang, uninstall: uninstall}, function(response) {
		$("#resultDisplay").html(response);
		console.log(response)
		
		location.reload();
	}
	);
}

function checkBox(){
	// var submit = $('#submitButton');
	// var back = $('#backButton');
	var button = $('#button');
	var box = $('#uninstall');

	if (box.is(':checked')){
		// console.log('ARE YOU SURE MATE');
		// back.css('display', 'none');
		// submit.css('display', 'inline');
		button.attr('onclick', 'submitSettings();');
		// button.removeClass('btn-danger');
		button.addClass('btn-danger');
		button.html(yes);
		$('#uninstall-label').html(pleaseConfirm);

	} else {
		// console.log('YEAH YOU BETTER RUN, BRO, GO BACK');
		// back.css('display', 'inline');
		// submit.css('display', 'none');
		button.removeAttr('onclick');
		button.attr('href', '../');
		button.removeClass('btn-danger');
		button.html(back);
		$('#uninstall-label').html(uninstall);
	}


}

$(document).ready(function(){
	$('#uninstall').change(function() {
		checkBox();
		// console.log("check 'em")

	});
});



