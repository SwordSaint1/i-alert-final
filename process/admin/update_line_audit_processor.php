<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'updatelineaudit') {
    $id = $_POST['id'];
	$shift = $_POST['shift'];
	$groups = $_POST['groups'];
	$audit_type = $_POST['audit_type'];
	$audit_categ = $_POST['audit_categ'];
	$carmaker = $_POST['carmaker'];
	$carmodel = $_POST['carmodel'];
	$emline = $_POST['emline'];
	$process = $_POST['process'];
	$audit_findings = $_POST['audit_findings'];
	$audited_by = $_POST['audited_by'];
	$audit_type = $_POST['audit_type'];
	$date_audited = $_POST['date_audited'];
	$remarks = $_POST['remarks'];
    
    $update = "UPDATE ialert_line_audit SET shift = '$shift', audit_type = '$audit_type', groups = '$groups', audit_type = '$audit_type', audited_categ = '$audit_categ', car_maker = '$carmaker', car_model = '$carmodel', line_no = '$emline', process = '$process',audit_findings = '$audit_findings', audited_by = '$audited_by', date_audited = '$date_audited', remarks = '$remarks',audit_type = '$audit_type', date_updated = '$server_date_only' WHERE id = '$id'";
    $stmt = $conn->prepare($update);
    if ($stmt->execute()) {
    	echo 'success';
    }else{
    	echo 'Error';
    }
   
} 
	
$conn = NULL;
?>