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
		console.log("enable button")
	} else {
		button.setAttributeNode(document.createAttribute("disabled"));
		console.log("disable button");
		document.getElementById("submitButton").classList.add('disabled');
	}
}



