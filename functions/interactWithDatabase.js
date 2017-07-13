  	function SubmitFormData() {
	    var addIncomingTitle = $("#addIncomingTitle").val();
	    var addIncomingDesc = $("#addIncomingDesc").val();
	    $.post("form-handling.php", { addIncomingTitle: addIncomingTitle, addIncomingDesc: addIncomingDesc},
	    console.log("post sent")
	    );
	} 
  	function editFormData(ident, editTitle, editDescription, editOwner) {
	    var editIncomingTitle = $(editTitle).val();
	    var editIncomingDesc = $(editDescription).val();
	    var editExisting = true;
		var ident = ident

	    $.post("form-handling.php", { ident: ident, editIncomingTitle: editIncomingTitle, editIncomingDesc: editIncomingDesc, editExisting: editExisting},
	    console.log("post sent")
	    ); 

	} 	
  	function removeEntry(ident, confirm) {
	    var ident = ident;
	    var confirmRemove = $(confirm).val();
	    confirmRemove = confirmRemove.toLowerCase();
	    if (confirmRemove == "yes"){
	    	console.log("delet this")
	    $.post("form-handling.php", { ident: ident, confirmRemove: true},
	    console.log("post sent")
	    ); 
	    } 
	    

	}
  	function editStatus(ident, confirm) {
	    var ident = ident;
	    var confirmEdit = $(confirm).val();
	    confirmEdit = confirmEdit.toLowerCase();
	    if (confirmEdit == "yes"){
	    	console.log("edit this")
	    $.post("form-handling.php", { ident: ident, confirmEditStatus: true},
	    console.log("post sent")
	    ); 
	    } 
	    

	}  
	function debug(string){
		console.log(string);
	}