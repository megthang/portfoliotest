<?php 	

require_once 'core.php';

$estimateId = $_POST['est_id'];

$sql = "SELECT * FROM categories WHERE est_id = $estimateId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);