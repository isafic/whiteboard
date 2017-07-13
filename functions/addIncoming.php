
<div id="addIncoming" class="modal fade" role="dialog">
				<div class="modal-dialog">

			    <!-- Modal content-->
				    <div class="modal-content">
				    	<div class="modal-header">
				        	<button type="button" class="close" data-dismiss="modal">&times;</button>
				        	<h4 class="modal-title">Add Incoming</h4>
				        </div>
				      
				        <form method="post" name="addIncomingForm"> <!-- action="form-handling.php" -->
				        <div class="modal-body">
				      
					        <input class="form-control input-lg" id="addIncomingTitle" type="text" placeholder="Enter title">
					        <br>
					        <textarea class="form-control" rows="5" id="addIncomingDesc" placeholder="Enter description"></textarea>
					
				        </div>

				        <div class="modal-footer">
					        <button type="button" class="btn btn-success" onclick="SubmitFormData();window.location.reload();" data-dismiss="modal">Save</button><!-- onclick="SubmitFormData();" data-dismiss="modal" -->

					        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					    </form>
					    </div>
				    </div> <!-- end of modal content -->
		    </div><!-- end of modal -->