<?php 
$config = parse_ini_file('config.ini', true);

if ($config['settings']['lang'] == "en") {
	include "lang/en.php";
} elseif ($config['settings']['lang'] == "hu") {
	include "lang/hu.php";
}

$addIncomingHeader = $lang['addIncomingHeader'];
$enterTitle = $lang['enterTitle'];
$enterDesc = $lang['enterDesc'];
$enterOwner = $lang['enterOwner'];
$save = $lang['save'];
$cancel = $lang['cancel'];


 ?>
<div id="addIncoming" class="modal fade" role="dialog">
				<div class="modal-dialog">

			    <!-- Modal content-->
				    <div class="modal-content">
				    	<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal">&times;</button>
				        	<h4 class="modal-title"><?php echo $addIncomingHeader; ?></h4>
				        </div>
				      
				        <form method="post" name="addIncomingForm"> <!-- action="form-handling.php" -->
				        <div class="modal-body">
				      
					        <input class="form-control input-lg" id="addIncomingTitle" type="text" placeholder="<?php echo $enterTitle; ?>" autofocus>
					        <br>
					        
					        
					        <textarea class="form-control" rows="5" id="addIncomingDesc" placeholder="<?php echo $enterDesc; ?>"></textarea>
					        <input class="form-control input" id="addIncomingOwner" type="text" placeholder="<?php echo $enterOwner; ?>">
					        

					
				        </div>

				        <div class="modal-footer">
					        <button type="button" class="btn btn-success" onclick="SubmitFormData();location.reload();" data-dismiss="modal"><?php echo $save; ?></button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

					        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $cancel; ?></button>
					    </form>
					    </div>
				    </div> <!-- end of modal content -->
		    </div><!-- end of modal -->
