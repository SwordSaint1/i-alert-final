<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'audit_count') {
	$employee_num_count = $_POST['employee_num_count'];
    $full_name_count = $_POST['full_name_count'];

	$count = "SELECT count(*) as total FROM ialert_audit WHERE employee_num LIKE '$employee_num_count%'
	AND full_name LIKE '$full_name_count%'";
	$stmt = $conn->prepare($count);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){

		echo '<tr>';

		echo '<td>'.$x['total'].'</td>';
				
		echo '</tr>';
	}
}

$conn = NULL;

?>