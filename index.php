
<?php 

$config = parse_ini_file('config.ini', true);

if ($config['settings']['lang'] == "en") {
	include "lang/en.php";
} elseif ($config['settings']['lang'] == "hu") {
	include "lang/hu.php";
}


if ($config['install']['is_installed'] != 1){
	die($lang['pleaseInstall']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $lang['title'];?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="functions/interactWithDatabase.js"></script>
	<?php 
		require "functions/panels.php";
		fetchData();
	?>
</head>

<body>

	<div class="container">
		<div class="page-header">




			<!-- <h1 align="center"><?php echo $lang['title'];?></h1>  -->
			<div class="panel-heading" align="center">
		  			<div class="btn">
		  				<h1><?php echo $lang['title'];?></h1>
		  			</div> 
		  			<a type="button" class="btn btn-primary btn-sm" href="./settings"><span class="glyphicon glyphicon-cog"></span></a>
		  		</div>

		</div>

		<div class="row">
			<div class="col-sm-3">

				<div class="panel panel-default">
		  		<div class="panel-heading" align="center">
		  			<div class="btn">
		  				<h1><?php echo $lang['one']; ?></h1>
		  			</div> 
		  			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addIncoming"><span class="glyphicon glyphicon-plus"></span></button>
		  		</div>
				</div>
				<?php
				foreach ($entry as $i){
					$id = $i['id'];
					$status = $i['status'];
					if ($status == 0){
						drawIncomingBox($id);
					}
				}
				?>
			
			</div>

			<div class="col-sm-3">

				<div class="panel panel-default">
		  		<div class="panel-heading" align="center">
		  				<h1><?php echo $lang['two']; ?></h1>
		  		</div>
				</div>
				<?php
				foreach ($entry as $i){
					$id = $i['id'];
					$status = $i['status'];
					if ($status == 1){
						drawWaitingBox($id);
					}
				}
				?>

			</div>


			<div class="col-sm-3">

				<div class="panel panel-default">
		  		<div class="panel-heading" align="center">
		  				<h1><?php echo $lang['three'] ?></h1>
		  		</div>
				</div>
				<?php
				foreach ($entry as $i){
					$id = $i['id'];
					$status = $i['status'];
					if ($status == 2){
						// drawIncomingBox($id);
						drawOngoingBox($id);
					}
				}
				?>

			</div>


			<div class="col-sm-3">

				<div class="panel panel-default">
		  		<div class="panel-heading" align="center">
		  				<h1><?php echo $lang['four']; ?></h1>
		  		</div>
				</div>
				<?php
				foreach ($entry as $i){
					$id = $i['id'];
					$status = $i['status'];
					if ($status == 3){
						drawFinishedBox($id);
					}
				}
				?>	

			</div>
		</div>

	</div>



<?php require "functions/addIncoming.php"; ?>

</body>
</html>