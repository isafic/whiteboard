var host; 
var user; 
var pass; 
var db;
var button;
function checkInput(){
	host = document.forms["sql-data"]["host"].value;
	user = document.forms["sql-data"]["user"].value;
	pass = document.forms["sql-data"]["pass"].value;
	button = document.getElementById("submitButton");
	db = document.forms["sql-data"]["db"].value;
	if ((host != "") && (user != "") && (pass != "") && (db != "")){
		button.removeAttribute("disabled");
		document.getElementById("submitButton").classList.remove('disabled');
	} else {
		button.setAttributeNode(document.createAttribute("disabled"));
		document.getElementById("submitButton").classList.add('disabled');
	}
}

function submitLogin() {
	var host = $("#host").val();
	var user = $("#user").val();
	var pass = $("#pass").val();
	var lang = $("#lang").val();

	button.setAttributeNode(document.createAttribute("disabled"));
	document.getElementById("submitButton").classList.add('disabled');
	var db = $("#db").val();
	$.post("install.php", { host: host, user: user, pass: pass, db: db, lang: lang}, function(response) {
		$("#resultDisplay").html(response);
		console.log(response)
		button.removeAttribute("disabled");
		document.getElementById("submitButton").classList.remove('disabled');
	}
	);
} 

var settingsPhp = "../settings/settings.php";
function changeLang() {
	var lang = $("#lang").val();
	$.post(settingsPhp, { lang: lang, uninstall: "false"});
	location.reload();
}



