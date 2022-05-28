<?php 	

require_once 'core.php';

$sql = "SELECT * FROM tbl_estimate WHERE est_stat = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeEstimate = ""; 

 while($row = $result->fetch_array()) {
 	$EstimateId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeEstimate = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeEstimate = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editEstimateModalBtn" data-target="#editEstimateModal" onclick="editEstimate('.$EstimateId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeEstimateModal" id="removeEstimateModalBtn" onclick="removeEstimate('.$EstimateId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeEstimate,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);