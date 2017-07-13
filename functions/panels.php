<?php
function debug( $data ) {
	$output = $data;
	if ( is_array( $output ) )
	    $output = implode( ',', $output);

	echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function fetchData(){
    $host = 'localhost';  
    $user = 'root';  
    $pass = 'toor';  
    $dbname = 'WHITEBOARD';  
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
}

function drawIncomingBox($ident) {
	global $entry;

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];

	$incomingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="Enter title." autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="Enter description">$viewDescription</textarea>
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident);window.location.reload();" data-dismiss="modal">Save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">View Entry</h4>
			      					</div>
			      					
				      				<div class="modal-body">
				      					
				        				<h3 align="left">$viewTitle</h3>

				        				<p align="left">$viewDescription</p>
				        								
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
								        <h4 class="modal-title">Remove Entry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="removeEntryConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident, removeEntryConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">Move To Waiting</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="editStatusConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident, editStatusConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];

	$incomingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="Enter title." autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="Enter description">$viewDescription</textarea>
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident);window.location.reload();" data-dismiss="modal">Save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">View Entry</h4>
			      					</div>
			      					
				      				<div class="modal-body">
				      					
				        				<h3 align="left">$viewTitle</h3>

				        				<p align="left">$viewDescription</p>
				        								
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
								        <h4 class="modal-title">Remove Entry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="removeEntryConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident, removeEntryConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">Move To Ongoing</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="editStatusConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident, editStatusConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
echo "$incomingBox";
}

function drawOngoingBox($ident) {
	global $entry;

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];

	$incomingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
					<div class="btn-group btn-group">
						<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editIncoming$ident"><span class="glyphicon glyphicon-pencil" ></span></p></a>

						<div id="editIncoming$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Edit</h4>
			      					</div>
			      					<form method="post" name="editIncomingForm$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      
								        <input class="form-control input-lg" id="editIncomingTitle$ident" type="text" value="$viewTitle" placeholder="Enter title." autofocus>
								        <br>
								        <textarea class="form-control" rows="5" id="editIncomingDesc$ident" placeholder="Enter description">$viewDescription</textarea>
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editFormData($ident, editIncomingTitle$ident, editIncomingDesc$ident);window.location.reload();" data-dismiss="modal">Save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">View Entry</h4>
			      					</div>
			      					
				      				<div class="modal-body">
				      					
				        				<h3 align="left">$viewTitle</h3>

				        				<p align="left">$viewDescription</p>
				        								
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
								        <h4 class="modal-title">Remove Entry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="removeEntryConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident, removeEntryConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
								        <h4 class="modal-title">Move To Finished</h4>
			      					</div>
			      					<form method="post" name="editStatus$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="editStatusConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="editStatus($ident, editStatusConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								    </form>
								        
				        			</div>
			        			</div> <!-- end of modal content -->
			    			</div> <!-- end of mode dialogue -->

			  		    
				    </div>	
		    	</div>	
			</div>
		</div>
			
HTML;
echo "$incomingBox";
}

function drawFinishedBox($ident) {
	global $entry;

	$viewTitle = $entry[$ident]['title'];
	$viewDescription = $entry[$ident]['description'];

	$incomingBox = 
	<<<HTML
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel" align="center"><h4 align="center">$viewTitle</h4> 
					<div class="btn-group btn-group">
						
					  	<a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewEntries$ident"><span class="glyphicon glyphicon-eye-open"></span></p></a>

					  	<div id="viewEntries$ident" class="modal fade" role="dialog">
			  				<div class="modal-dialog">
								<div class="modal-content"> <!-- Modal content-->
			        				<div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">View Entry</h4>
			      					</div>
			      					
				      				<div class="modal-body">
				      					
				        				<h3 align="left">$viewTitle</h3>

				        				<p align="left">$viewDescription</p>
				        								
				      				</div>

				      				<div class="modal-footer">
								       
									
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
								        <h4 class="modal-title">Remove Entry</h4>
			      					</div>
			      					<form method="post" name="removeEntry$ident"> <!-- action="form-handling.php" -->
							        <div class="modal-body">
							      		
								        <input class="form-control input-lg" id="removeEntryConfirm$ident" type="text"  placeholder="Please type ' yes ' to confirm.">
								        
								
							        </div>

							        <div class="modal-footer">
								        <button type="button" class="btn btn-success" onclick="removeEntry($ident, removeEntryConfirm$ident);window.location.reload();" data-dismiss="modal">Confirm</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
echo "$incomingBox";
}


?>
