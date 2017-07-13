<?php

// $editExisting = $_POST['editExisting'];
// $editStatus = $_POST['editStatus'];
// $downStatus = $_POST['downStatus'];

// logic:
// if &$downStatus then editStatus(false);
// if NOT &$editExisting or &$editStatus THEN addNewEntry();
// else if &$editExisting and NOT &$editStatus THEN editEntry(args); 
// else editStatus(true);

// addNewEntry() function adds a new entry to the database, with NULL owner, status 0.
// editEntry() edits an existing entry's fields (except for status)
// editStatus(status) edits an existing entry's status field. if &status, adds one (unless at max). if false, removes one (unless at min, in which case, the entry is deleted)

if (isset($_POST['editExisting'])){
	$ident = "'".$_POST['ident']."'";
	$editIncomingTitle = "'".$_POST['editIncomingTitle']."'";
	$editIncomingDesc = "'".$_POST['editIncomingDesc']."'";
	$editExisting = true;
	$confirmRemove = false;
} elseif (isset($_POST['confirmEditStatus'])){
	$ident = "'".$_POST['ident']."'";
	$confirmRemove = false;
	$confirmEditStatus = true;
} elseif (isset($_POST['confirmRemove']) and $_POST['confirmRemove']){
	$ident = "'".$_POST['ident']."'";
	$confirmRemove = true;
} else {
	$addIncomingTitle = "'".$_POST['addIncomingTitle']."'";
	$addIncomingDesc = "'".$_POST['addIncomingDesc']."'";
	$editExisting = false;
	$confirmRemove = false;
}


$host = 'localhost';  
$user = 'root';  
$pass = 'toor';  
$dbname = 'WHITEBOARD';  
$conn = mysqli_connect($host, $user, $pass,$dbname); 
if(!$conn){  
   die('Could not connect: '.mysqli_connect_error());  
}   
echo 'Connected successfully<br/>'; 

function addNewEntry(){
	global $addIncomingTitle;
	global $addIncomingDesc;
	global $conn;
	$sql = 'INSERT INTO whiteboard_data (title, description, status) VALUES ('.$addIncomingTitle.', '.$addIncomingDesc.', 0)';

	if (mysqli_query($conn, $sql)){
		echo "we did it";
	} else {
		echo("Error description: " . mysqli_error($conn));
	}

}

function editEntry(){
	global $editIncomingTitle;
	global $editIncomingDesc;
	global $ident;
	global $conn;
	echo "goodie";
	$sql = ' UPDATE whiteboard_data SET title='.$editIncomingTitle.', description='.$editIncomingDesc.' WHERE id='.$ident.' ';

	if (mysqli_query($conn, $sql)){
		echo "we did it";
	} else {
		echo("Error description: " . mysqli_error($conn));
	}	
}

function removeEntry(){
	global $ident;
	global $conn;
	$sql = ' DELETE FROM whiteboard_data WHERE id = '.$ident.' ';

	if (mysqli_query($conn, $sql)){
		echo "we did it";
	} else {
		echo("Error description: " . mysqli_error($conn));
	}		
}

function editStatus(){
	global $ident;
	global $conn;
	$sql = ' UPDATE whiteboard_data SET status = status + 1 WHERE id = '.$ident.' ';

	if (mysqli_query($conn, $sql)){
		echo "we did it";
	} else {
		echo("Error description: " . mysqli_error($conn));
	}		
}
if ($confirmEditStatus){
	editStatus();
} elseif ($confirmRemove){
	removeEntry();
} elseif (! $editExisting){
	addNewEntry();
} else{
	editEntry();
}

mysqli_close($conn);
?>