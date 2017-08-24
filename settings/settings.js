var lang;


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



