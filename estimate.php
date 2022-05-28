<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Estimate</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Estimate</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addEstimateModalBtn" data-target="#addEstimateModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Estimate </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageEstimateTable">
					<thead>
						<tr>							
							<th>Product Details</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add Estimate -->
<div class="modal fade" id="addEstimateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitEstimateForm" action="php_action/createEstimate.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Estimate</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-Estimate-messages"></div>

	        <div class="form-group">
	        	<label for="dimensionWidth" class="col-sm-4 control-label">Width(in): </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="dimensionWidth" placeholder="Width" name="dimensionWidth" autocomplete="off">
				</div>
	        </div> <!-- /form-group-->
			<div class="form-group">
			<label for="dimensionHeight" class="col-sm-4 control-label">Height(in): </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="dimensionHeight" placeholder="Width" name="dimensionHeight" autocomplete="off">
				</div>
	        </div> <!-- /form-group-->    
			<div class="form-group">
				<label for="estQuantity" class="col-sm-4 control-label">Quantity: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="estQuantity" placeholder="Quantity" name="estQuantity" autocomplete="off">
				</div>
	        </div> <!-- /form-group-->  
			<div class="form-group">
	        	<label for="productType" class="col-sm-4 control-label">Product Type: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="productType" name="productType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">TY Card</option>
				      	<option value="2">Fridge Magnet</option>
						  <option value="3">PVC</option>
				      </select>
				    </div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
	        	<label for="qualType" class="col-sm-4 control-label">Quality Type: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="qualType" name="qualType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Regular</option>
				      	<option value="2">Gloss Finish</option>
						<option value="3">Matte Finish</option>
						<option value="4">Glitter Finish</option>
						<option value="5">PVC</option>
				      </select>
				    </div>
	        </div> <!-- /form-group--> 
			<div class="modal-footer">
	        	<!--button type="submit" class="btn btn-primary" id="showEstimateBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Estimate</button-->
				<button type="button" class="btn btn-primary" onclick="test()" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Estimate</button>
	      	</div> <!-- /modal-footer -->	 
			  <script type='text/javascript'>
				  	function test(){
						var dimensionWidth = document.getElementById("dimensionWidth").value;
						var dimensionHeight = document.getElementById("dimensionHeight").value;
						var estQuantity = document.getElementById("estQuantity").value;
						var productType = document.getElementById("productType").value;
						var qualType = document.getElementById("qualType").value;
						
						var dim=dimensionWidth*dimensionHeight;
						var dim_quant=dim;var fitSheet=1;
						while(dim_quant<84){fitSheet++;//alert(dim_quant);
							//if(fitSheet>1){
								dim_quant=fitSheet*dim;
							//}
						}
						fitSheet--;
						var quality=35;
						var perpc=quality/fitSheet;
						var subtotal=perpc*estQuantity;
						var fit=estQuantity/fitSheet;
						var total=0.0;var remarks='';var discount='Need more quantity to get discount';
						if(fit>=5){total=subtotal*0.1;discount='10%'}else{total=subtotal;}
						document.getElementById("fitPerSheet").value = fitSheet;
						document.getElementById("estCostEach").value = perpc;
						document.getElementById("subtotal").value = subtotal;
						document.getElementById("discount").value = discount;
						document.getElementById("total").value = total;
					}
					/*function test (type) {
                    var cat_options = { 1: 'cat-1',2: 'cat-2',3: 'cat-3', 4: 'cat-4', 5: 'cat-5',6: 'cat-6', 7: 'cat-7', 8: 'cat-8', 9: 'Default item' };
                    const categories = ["cat-1", "cat-2", "cat-3", "cat-4", "cat-5", "cat-6", "cat-7", "cat-8"];
                    var cris = document.getElementById(cat_options[type]); cris.classList.add("fColor");
                    for (let i = 0; i < categories.length; i++) {
                      var temp=categories[i];
                      if(cat_options[type]===temp){cris.classList.add("fColor");}
                      else{ var hold=document.getElementById(temp); hold.classList.remove("fColor");}
                    }
                  }*/
			  </script>
			<div class="form-group">
				<label for="fitPerSheet" class="col-sm-4 control-label">Quantity per sheet: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="fitPerSheet" placeholder="Quantity per sheet" name="fitPerSheet" autocomplete="off" disabled>
				</div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
				<label for="estCostEach" class="col-sm-4 control-label">Estimated cost each: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="estCostEach" placeholder="Estimated cost each" name="estCostEach" autocomplete="off" disabled>
				</div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
				<label for="subtotal" class="col-sm-4 control-label">Subtotal: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="subtotal" placeholder="Subtotal" name="subtotal" autocomplete="off" disabled>
				</div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
				<label for="discount" class="col-sm-4 control-label">Discount: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="discount" placeholder="Discount" name="discount" autocomplete="off" disabled>
				</div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
				<label for="total" class="col-sm-4 control-label">Total: </label>
	        	<label class="col-sm-1 control-label">: </label>
				<div class="col-sm-7">
					<input type="text" class="form-control" id="total" placeholder="Total" name="total" autocomplete="off" disabled>
				</div>
	        </div> <!-- /form-group-->	         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-primary" id="createEstimateBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Estimate</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add Estimate -->


<!-- edit Estimate brand -->
<div class="modal fade" id="editEstimateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editEstimateForm" action="php_action/editEstimate.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-Estimate-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-Estimate-result">
		      	<div class="form-group">
		        	<label for="editEstimateName" class="col-sm-4 control-label">Estimate Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editEstimateName" placeholder="Estimate Name" name="editEstimateName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		        <div class="form-group">
		        	<label for="editEstimateStatus" class="col-sm-4 control-label">Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editEstimateStatus" name="editEstimateStatus">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Available</option>
					      	<option value="2">Not Available</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->	 
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editEstimateFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editEstimateBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /Estimate brand -->

<!-- Estimate brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeEstimateModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Brand</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeEstimateFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeEstimateBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /Estimate brand -->


<script src="custom/js/estimate.js"></script>

<?php require_once 'includes/footer.php'; ?>