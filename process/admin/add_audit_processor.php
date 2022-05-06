<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if($method == 'AuditCode'){
		$prefix = "AC:";
		$dateCode = date('ymd');
		$randomCode = mt_rand(10000,50000);
		echo $prefix."".$dateCode."".$randomCode;
	}

if($method == 'fetch_details_req'){
        $employee_num = trim($_POST['employee_num']);
        // CHECK
        $sql = "SELECT idNumber, empName, empPosition, empAgency, lineNo FROM a_m_employee WHERE idNumber = '$employee_num'";
        $stmt = $conn2->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
        	foreach($stmt->fetchALL() as $x){
            echo $x['empName'].'~!~'.$x['empPosition'].'~!~'.$x['empAgency'].'~!~'.$x['lineNo'];
        }
    }else{
    	echo '';
    }
}

if ($method == 'insert_audit') {

	$employee_num = trim($_POST['employee_num']);
	$full_name = $_POST['full_name'];
	$position = $_POST['position'];
	$provider = $_POST['provider'];
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
	$section = $_POST['section'];

	$insert = "INSERT INTO ialert_audit (`batch`, `date_audited`, `full_name`,`employee_num`,`provider`,`position`,`shift`,`groups`,`car_maker`,`car_model`,`line_no`,`process`,`audit_findings`,`audited_by`,`audited_categ`,`audit_type`,`remarks`,`pd`,`hr`,`agency`,`date_created`,`section`) VALUES('$audit_code', '$date_audited','$full_name','$employee_num','$provider','$position','$shift','$group','$carmaker','$carmodel','$emline','$emprocess','$audit_findings','$audited_by','$audit_categ','$audit_type','$remarks',NULL,NULL,NULL,'$server_date_time','$section')";
		$stmt= $conn->prepare($insert);
		if ($stmt->execute()) {
			echo 'Successfully Saved';
		}else{
			echo 'Error';
		}
}

if ($method == 'prev_audit') {
	$c =0;
	$audit_code = trim($_POST['audit_code']);
	$query = "SELECT * FROM ialert_audit WHERE batch LIKE '$audit_code%' ORDER BY id ASC";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	foreach($stmt->fetchALL() as $x){
		$c++;
		echo '<tr>';

		echo '<td>'.$c.'</td>';
		echo '<td>'.$x['date_audited'].'</td>';
		echo '<td>'.$x['full_name'].'</td>';
		echo '<td>'.$x['employee_num'].'</td>';
		echo '<td>'.$x['provider'].'</td>';
		echo '<td>'.$x['position'].'</td>';
		echo '<td>'.$x['shift'].'</td>';
		echo '<td>'.$x['groups'].'</td>';			
		echo '<td>'.$x['car_maker'].'</td>';
		echo '<td>'.$x['car_model'].'</td>';
		echo '<td>'.$x['line_no'].'</td>';
		echo '<td>'.$x['process'].'</td>';	
		echo '<td>'.$x['audit_findings'].'</td>';
		echo '<td>'.$x['audited_by'].'</td>';	
		echo '<td>'.$x['audited_categ'].'</td>';
		echo '<td>'.$x['remarks'].'</td>';	
		echo '<td>'.$x['section'].'</td>';			
		echo '</tr>';
	}
}
$conn = NULL;
?>