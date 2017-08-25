<?php
$config = parse_ini_file(dirname( dirname(__FILE__) ).'/config.ini', true);

if ($config['settings']['lang'] == "en") {
	include "lang/en.php";
} elseif ($config['settings']['lang'] == "hu") {
	include "lang/hu.php";
}



	
	$edit = $lang['editHeader'];
	$enterTitle = $lang['enterTitle'];
	$enterDesc = $lang['enterDesc'];
	$enterOwner = $lang['enterOwner'];
	$save = $lang['save'];
	$cancel = $lang['cancel'];
	$close = $lang['close'];
	$confirm = $lang['confirm'];
	$viewEntry = $lang['viewEntry'];
	$removeEntry = $lang['removeEntry'];
	$moveTo1 = $lang['moveTo1'];
	$moveTo2 = $lang['moveTo2'];
	$moveTo3 = $lang['moveTo3'];




function debug( $data ) {
	$output = $data;
	if ( is_array( $output ) )
	    $output = implode( ',', $output);

	echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function fetchData(){
	$config = parse_ini_file(dirname( dirname(__FILE__) ).'/config.ini', true);


	$host = $config['database']['host'] ;
	$user = $config['database']['user'] ;
	$pass = $config['database']['pass']  ;
	$dbname = $config['database']['db'] ;
    $conn = mysqli_connect($host, $user, $pass,$dbname);
    global $entry;
    $entry = [];
    if(!$conn){  
       die('Could not connect: '.mysqli_connect_error());  
    }    //echo 'Connected successfully<br/>';  

    $sql = "SELECT * FROM whiteboard_data ORDER BY id asc";   

    if($result = mysqli_query($conn, $sql)){  
       $num_rows = mysqli_num_rows($result);
       //echo($num_rows);
		while($row = mysqli_fetch_array($result)){
			$id = $row['id'];
			$title = $row['title'];
			$description = $row['description'];
			$owner = $row['owner'];
			$status = $row['status'];
			$entry[$id] = [
				'id' => $id,
				'title' => $title, 
				'description' => $description,
				'owner' => $owner, 
				'status' => $status
			];
		}
    } else {  
       echo("Error description: " . mysqli_error($conn)); 
    }  
    mysqli_close($conn);  
    // var_dump($entry);
}
// echo $entry;
function drawIncomingBox($ident) {
	global $entry;
	// var_dump($entry);
	// var_dump($entry[$ident]['title']);
	global $lang;
	global $viewTitle;
	global $viewDescription;
	global $viewOwner;
	global $owner;
	global $edit;
	global $enterTitle;
	global $enterDesc;
	global $enterOwner;
	global $save;
	global $cancel;
	global $close;
	global $confirm;
	global $viewEntry;
	global $removeEntry;
	global $moveTo1;
	global $moveTo2;
	global $moveTo3;


	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];
	$viewOwner = $entry[$ident]['owner'];
	$owner = $lang['drawOwner'] . $viewOwner;


	$incomingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
					<h5 align="center">$owner</h5> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="$enterTitle" autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="$enterDesc" autofocus>$viewDescription</textarea>
								         <input class="form-control input" id="editIncomingOwner$ident" type="text" value="$viewOwner" placeholder="$enterOwner">
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident, editIncomingOwner$ident);window.location.reload();" data-dismiss="modal">$save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of editIncoming -->
					
					  	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewEntries$ident"><span class="glyphicon glyphicon-eye-open"></span></p></a>

					  	<div id="viewEntries$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$viewEntry</h4>
			      					</div>
			      					
				      				<div class="modal-body" style="text-align: left;">
				      					<div class="panel panel-default">
				        				<h3 align="left" style="padding: 10px;">$viewTitle</h3>
				        				</div>
				        				<div class="panel panel-default">
				        				<h5 align="left" style="padding: 10px;">$owner</h5>
				        				</div>
				        				<div class="panel panel-default" style="padding: 10px;">
				        				<p align="left">$viewDescription</p>
				        				</div>
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">$close</button>
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of viewEntries -->

						<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeEntry$ident"><span class="glyphicon glyphicon-remove"></span></p></a>
						<!-- Modal -->
						<div id="removeEntry$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$removeEntry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->


							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of removeEntry -->
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editStatus$ident"><span class="glyphicon glyphicon-ok"></span></p></a>
						<!-- Modal -->
						<div id="editStatus$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$moveTo1</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->


							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of editStatus -->
				    </div>	
		    	</div>	
			</div>
		</div>
			
HTML;
echo "$incomingBox";
}

function drawWaitingBox($ident) {
	global $entry;
	global $lang;
	
	global $viewTitle;
	global $viewDescription;
	global $viewOwner;
	global $owner;
	global $edit;
	global $enterTitle;
	global $enterDesc;
	global $enterOwner;
	global $save;
	global $cancel;
	global $close;
	global $confirm;
	global $viewEntry;
	global $removeEntry;
	global $moveTo1;
	global $moveTo2;
	global $moveTo3;

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];
	$viewOwner = $entry[$ident]['owner'];
	$owner = $lang['drawOwner'] . $viewOwner;

	$waitingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
									<h5 align="center">$owner</h5> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="Enter title." autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="Enter description" autofocus>$viewDescription</textarea>
										<input class="form-control input" id="editIncomingOwner$ident" type="text" value="$viewOwner" placeholder="Enter Owner.">
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident, editIncomingOwner$ident);window.location.reload();" data-dismiss="modal">$save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of editIncoming -->
					
					  	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewEntries$ident"><span class="glyphicon glyphicon-eye-open"></span></p></a>

					  	<div id="viewEntries$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$viewEntry</h4>
			      					</div>
			      					
				      			<div class="modal-body" style="text-align: left;">
				      					<div class="panel panel-default">
				        				<h3 align="left" style="padding: 10px;">$viewTitle</h3>
				        				</div>
				        				<div class="panel panel-default">
				        				<h5 align="left" style="padding: 10px;">$owner</h5>
				        				</div>
				        				<div class="panel panel-default" style="padding: 10px;">
				        				<p align="left">$viewDescription</p>
				        				</div>
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">$close</button>
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of viewEntries -->

						<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeEntry$ident"><span class="glyphicon glyphicon-remove"></span></p></a>
						<!-- Modal -->
						<div id="removeEntry$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$removeEntry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->


							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of removeEntry -->
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editStatus$ident"><span class="glyphicon glyphicon-ok"></span></p></a>
						<!-- Modal -->
						<div id="editStatus$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$moveTo2</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    
				    </div>	
		    	</div>	
			</div>
		</div>
	</div>
			
HTML;
echo "$waitingBox";
}

function drawOngoingBox($ident) {
	global $entry;
	global $lang;

	global $viewTitle;
	global $viewDescription;
	global $viewOwner;
	global $owner;
	global $edit;
	global $enterTitle;
	global $enterDesc;
	global $enterOwner;
	global $save;
	global $cancel;
	global $close;
	global $confirm;
	global $viewEntry;
	global $removeEntry;
	global $moveTo1;
	global $moveTo2;
	global $moveTo3;

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];
	$viewOwner = $entry[$ident]['owner'];
	$owner = $lang['drawOwner'] . $viewOwner;
	

	$ongoingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
								<h5 align="center">$owner</h5> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="Enter title." autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="Enter description" autofocus>$viewDescription</textarea>
										<input class="form-control input" id="editIncomingOwner$ident" type="text" value="$viewOwner" placeholder="Enter Owner.">
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident, editIncomingOwner$ident);window.location.reload();" data-dismiss="modal">$save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of editIncoming -->
					
					  	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewEntries$ident"><span class="glyphicon glyphicon-eye-open"></span></p></a>

					  	<div id="viewEntries$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$viewEntry</h4>
			      					</div>
			      					
				      			<div class="modal-body" style="text-align: left;">
				      					<div class="panel panel-default">
				        				<h3 align="left" style="padding: 10px;">$viewTitle</h3>
				        				</div>
				        				<div class="panel panel-default">
				        				<h5 align="left" style="padding: 10px;">$owner</h5>
				        				</div>
				        				<div class="panel panel-default" style="padding: 10px;">
				        				<p align="left">$viewDescription</p>
				        				</div>
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">$close</button>
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of viewEntries -->

						<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeEntry$ident"><span class="glyphicon glyphicon-remove"></span></p></a>
						<!-- Modal -->
						<div id="removeEntry$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$removeEntry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->


							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of removeEntry -->
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editStatus$ident"><span class="glyphicon glyphicon-ok"></span></p></a>
						<!-- Modal -->
						<div id="editStatus$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$moveTo3</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    
				    </div>	
		    	</div>	
			</div>
		</div>
		</div>
			
HTML;
echo "$ongoingBox";
}

function drawFinishedBox($ident) {
	global $entry;
	global $lang;

	
	global $viewTitle;
	global $viewDescription;
	global $viewOwner;
	global $owner;
	global $edit;
	global $enterTitle;
	global $enterDesc;
	global $enterOwner;
	global $save;
	global $cancel;
	global $close;
	global $confirm;
	global $viewEntry;
	global $removeEntry;
	global $moveTo1;
	global $moveTo2;
	global $moveTo3;
	
	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];
	$viewOwner = $entry[$ident]['owner'];
	$owner = $lang['drawOwner'] . $viewOwner;

	$finishedBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
									<h5 align="center">$owner</h5> 
					<div class="btn-group btn-group">
						
					  	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewEntries$ident"><span class="glyphicon glyphicon-eye-open"></span></p></a>

					  	<div id="viewEntries$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$viewEntry</h4>
			      					</div>
			      					
				      				<div class="modal-body" style="text-align: left;">
				      					<div class="panel panel-default">
				        				<h3 align="left" style="padding: 10px;">$viewTitle</h3>
				        				</div>
				        				<div class="panel panel-default">
				        				<h5 align="left" style="padding: 10px;">$owner</h5>
				        				</div>
				        				<div class="panel panel-default" style="padding: 10px;">
				        				<p align="left">$viewDescription</p>
				        				</div>
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">$close</button>
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of viewEntries -->

						<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#removeEntry$ident"><span class="glyphicon glyphicon-remove"></span></p></a>
						<!-- Modal -->
						<div id="removeEntry$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">$removeEntry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->


							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident);window.location.reload();" data-dismiss="modal">$confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">$cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    </div> <!-- end of removeEntry -->
						
				    </div>	
		    	</div>	
			</div>
		</div>
			
HTML;
echo "$finishedBox";
}


?>
