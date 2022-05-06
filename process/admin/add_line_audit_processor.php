<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if($method == 'LineAuditCode'){
		$prefix = "LAC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
}

if ($method == 'insert_line_audit') {

	$shift = $_POST['shift'];
	$group = $_POST['group'];
	$date_audited = $_POST['date_audited'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$emprocess = $_POST['emprocess'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$remarks = $_POST['remarks'];
	$esection = $_POST['esection'];
	$username = $_POST['username'];
	$audit_code = trim($_POST['audit_code']);

	$insert = "INSERT INTO ialert_line_audit (`batch`, `date_audited`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`date_created`) VALUES('$audit_code', '$date_audited','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks','$server_date_time')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {

			echo 'Successfully Saved';
		
		}else{
			
			echo 'Error';
		
		}

}

if ($method == 'prev_line_audit') {
	$c =0;
	$audit_code = trim($_POST['audit_code']);
	$query = "SELECT * FROM ialert_line_audit WHERE batch LIKE '$audit_code%' ORDER BY id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';
			echo '<td>'.$c.'</td>';
			echo '<td>'.$x['date_audited'].'</td>';
			echo '<td>'.$x['shift'].'</td>';
			echo '<td>'.$x['groups'].'</td>';			
			echo '<td>'.$x['car_maker'].'</td>';
			echo '<td>'.$x['car_model'].'</td>';
			echo '<td>'.$x['line_no'].'</td>';
			echo '<td>'.$x['process'].'</td>';	
			echo '<td>'.$x['audit_findings'].'</td>';
			echo '<td>'.$x['audited_by'].'</td>';	
			echo '<td>'.$x['audited_categ'].'</td>';
			echo '<td>'.$x['audit_type'].'</td>';
			echo '<td>'.$x['remarks'].'</td>';			
		echo '</tr>';
	}
}

$conn = NULL;
?>