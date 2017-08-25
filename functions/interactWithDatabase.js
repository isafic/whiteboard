  	function SubmitFormData() {
	    var addIncomingTitle = $("#addIncomingTitle").val();
	    // var addIncomingDesc = $("#addIncomingDesc").val();
	    var addIncomingDesc = tinyMCE.activeEditor.getContent();
	    var addIncomingOwner = $("#addIncomingOwner").val();
	    $.post("form-handling.php", { addIncomingTitle: addIncomingTitle, addIncomingDesc: addIncomingDesc, addIncomingOwner: addIncomingOwner},
	    console.log("post sent")
	    );
	} 
  	function editFormData(ident, editTitle, editDescription, editOwner) {
	    var editIncomingTitle = $(editTitle).val();
	    var editIncomingDesc = tinyMCE.activeEditor.getContent();
	    var editIncomingOwner = $(editOwner).val();
	    var editExisting = true;
		var ident = ident

	    $.post("form-handling.php", { ident: ident, editIncomingTitle: editIncomingTitle, editIncomingDesc: editIncomingDesc, editIncomingOwner: editIncomingOwner, editExisting: editExisting},
	    console.log("post sent")
	    ); 

	} 	
  	function removeEntry(ident) {
	    var ident = ident;
	    $.post("form-handling.php", { ident: ident, confirmRemove: true},
	    console.log("post sent")
	    ); 
	    
	    

	}
  	function editStatus(ident, confirm) {
	    var ident = ident;
	    $.post("form-handling.php", { ident: ident, confirmEditStatus: true},
	    console.log("post sent")
	    ); 
	    } 
	    


	function debug(string){
		console.log(string);
	}