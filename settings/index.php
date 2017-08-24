<?php

$configFile = dirname( dirname(__FILE__) ).'/config.ini';
$config = parse_ini_file($configFile, true);

if ($config['settings']['lang'] == "en") {
	include dirname( dirname(__FILE__) )."/lang/en.php";
	$LANG = "en";
} elseif ($config['settings']['lang'] == "hu") {
	include dirname( dirname(__FILE__) )."/lang/hu.php";
	$LANG = "hu";
}

$settings = $lang['settings'];
$language = $lang['lang'];	
$save = $lang['save'];
$back = $lang['back'];
$uninstall = $lang['uninstall'];

?>
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
	<script src="settings.js"></script>

</head>
<body>
<div class="container">
	<div class="page-header">
		<h1 align="center"><?php echo $settings; ?></h1>
	</div>

	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-md-5">
	
		<form id = "settings">
			<div class="form-group">
				<label for="lang"><?php echo $language; ?></label>
				<select id="lang" class="form-control">
					<option value="en" <?php if ($LANG == "en") { echo 'selected = "selected"'; } ?> >English</option>
					<option value="hu" <?php if ($LANG == "hu") { echo 'selected = "selected"'; } ?>>Magyar</option>
				</select>
			</div>

			<div class="form-group">
				<label for="uninstall"><?php echo $uninstall; ?></label>
				
				<input type='checkbox' id='uninstall' value='1'>
			</div>
		
			<div class="text-center">
			<br>

			<button type="button" id="submitButton" class="btn btn-success btn-lg" onclick="submitSettings();" ><?php echo $save; ?></button>
			<a type="button" id="submitButton" class="btn btn-danger btn-lg" href="../" ><?php echo $back; ?></a>

			
			</form>
			
		</div>
		<div class="col-md-5" id="resultDisplay">

			
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>

</body>

</html>