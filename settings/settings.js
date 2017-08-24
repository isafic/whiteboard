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
	console.log(uninstall);

	$.post("settings.php", { lang: lang, uninstall: uninstall}, function(response) {
		$("#resultDisplay").html(response);
		console.log(response)
		
		location.reload();
	}
	);
}



