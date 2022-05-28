var manageEstimateTable;

$(document).ready(function() {
	// active top navbar Estimate
	$('#navEstimate').addClass('active');	

	manageEstimateTable = $('#manageEstimateTable').DataTable({
		'ajax' : 'php_action/fetchEstimate.php',
		'order': []
	}); // manage Estimate Data Table

	// on click on submit Estimate form modal
	$('#addEstimateModalBtn').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitEstimateForm")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit Estimate form function
		$("#submitEstimateForm").unbind('submit').bind('submit', function() {

			var EstimateName = $("#EstimateName").val();
			var EstimateStatus = $("#EstimateStatus").val();

			if(EstimateName == "") {
				$("#EstimateName").after('<p class="text-danger">Brand Name field is required</p>');
				$('#EstimateName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#EstimateName").find('.text-danger').remove();
				// success out for form 
				$("#EstimateName").closest('.form-group').addClass('has-success');	  	
			}

			if(EstimateStatus == "") {
				$("#EstimateStatus").after('<p class="text-danger">Brand Name field is required</p>');
				$('#EstimateStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#EstimateStatus").find('.text-danger').remove();
				// success out for form 
				$("#EstimateStatus").closest('.form-group').addClass('has-success');	  	
			}

			if(EstimateName && EstimateStatus) {
				var form = $(this);
				// button loading
				$("#createEstimateBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#createEstimateBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table 
							manageEstimateTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#submitEstimateForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-Estimate-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if

					} // /success
				}); // /ajax	
			} // if

			return false;
		}); // submit Estimate form function
	}); // /on click on submit Estimate form modal	

}); // /document

// edit Estimate function
function editEstimate(EstimateId = null) {
	if(EstimateId) {
		// remove the added Estimate id 
		$('#editEstimateId').remove();
		// reset the form text
		$("#editEstimateForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit Estimate messages
		$("#edit-Estimate-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-Estimate-result').addClass('div-hide');
		//modal footer
		$(".editEstimateFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedEstimate.php',
			type: 'post',
			data: {EstimateId: EstimateId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-Estimate-result').removeClass('div-hide');
				//modal footer
				$(".editEstimateFooter").removeClass('div-hide');	

				// set the Estimate name
				$("#editEstimateName").val(response.Estimate_name);
				// set the Estimate status
				$("#editEstimateStatus").val(response.Estimate_active);
				// add the Estimate id 
				$(".editEstimateFooter").after('<input type="hidden" name="editEstimateId" id="editEstimateId" value="'+response.Estimate_id+'" />');


				// submit of edit Estimate form
				$("#editEstimateForm").unbind('submit').bind('submit', function() {
					var EstimateName = $("#editEstimateName").val();
					var EstimateStatus = $("#editEstimateStatus").val();

					if(EstimateName == "") {
						$("#editEstimateName").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editEstimateName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editEstimateName").find('.text-danger').remove();
						// success out for form 
						$("#editEstimateName").closest('.form-group').addClass('has-success');	  	
					}

					if(EstimateStatus == "") {
						$("#editEstimateStatus").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editEstimateStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editEstimateStatus").find('.text-danger').remove();
						// success out for form 
						$("#editEstimateStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(EstimateName && EstimateStatus) {
						var form = $(this);
						// button loading
						$("#editEstimateBtn").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editEstimateBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageEstimateTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-Estimate-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit Estimate form

			} // /success
		}); // /fetch the selected Estimate data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit Estimate function

// remove Estimate function
function removeEstimate(EstimateId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedEstimate.php',
		type: 'post',
		data: {EstimateId: EstimateId},
		dataType: 'json',
		success:function(response) {			

			// remove Estimate btn clicked to remove the Estimate function
			$("#removeEstimateBtn").unbind('click').bind('click', function() {
				// remove Estimate btn
				$("#removeEstimateBtn").button('loading');

				$.ajax({
					url: 'php_action/removeEstimate.php',
					type: 'post',
					data: {EstimateId: EstimateId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove Estimate btn
							$("#removeEstimateBtn").button('reset');
							// close the modal 
							$("#removeEstimateModal").modal('hide');
							// update the manage Estimate table
							manageEstimateTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removeEstimateModal").modal('hide');

 							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the Estimate data
			}); // /remove Estimate btn clicked to remove the Estimate function

		} // /response
	}); // /ajax function to fetch the Estimate data
} // remove Estimate function