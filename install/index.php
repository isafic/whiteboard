<!DOCTYPE html>
<html lang="en">
<head>
	<title>Whiteboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../functions/interactWithDatabase.js"></script>
	<script src="install.js"></script>
</head>
<body>
<div class="container">
	<div class="page-header">
		<h1 align="center">Install Whiteboard</h1>
	</div>

	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-md-5">
		<h3>MySQL Database Login</h3><br>
		<form id = "sql-data">
			<div class="form-group">
			<label for="host">Host</label>
			<input type="text" class="form-control" id="host" placeholder="localhost" onkeyup="checkInput();" autofocus>
			</div>

			<div class="form-group">
			<label for="user">Username</label>
			<input type="text" class="form-control" id="user" placeholder="root" onkeyup="checkInput();">
			</div>

			<div class="form-group">
			<label for="pass">Password</label>
			<input type="password" class="form-control" id="pass" placeholder="••••••••••••" onkeyup="checkInput();">
			</div>	

			<div class="form-group">
			<label for="db">Database</label>
			<input type="text" class="form-control" id="db" placeholder="WHITEBOARD" aria-describedby="dbHelpBlock"  onkeyup="checkInput();">
			<p id="passwordHelpBlock" class="form-text text-muted">
				If the database does not already exist, it will be created.
			</p>
			</div>		
			
			<div class="text-center">
			<br>
			<button type="button" id="submitButton" class="btn btn-success disabled btn-lg" onclick="console.log('click');" disabled="">Submit</button>
			</div>
			</form>
		</div>
		<div class="col-md-5">

			
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>

</body>

</html>