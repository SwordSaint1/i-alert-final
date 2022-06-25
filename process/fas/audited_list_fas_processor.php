<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'count_for_update_fas') {
    $server_date = $_POST['server_date'];
    $car_maker = $_POST['car_maker'];
    $esection = $_POST['esection'];
    $section = $_POST['section'];
    $count = "SELECT *,count(*) as total FROM ialert_audit ";
  
    $stmt = $conn->prepare($count);
    $stmt->execute();
    foreach($stmt->fetchALL() as $x){

        $date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $agency = $x['agency'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));

        $count_na = "SELECT COUNT(*) as total FROM ialert_audit WHERE provider = 'FAS' AND section = '$section' AND date_sent IS NULL AND edit_count != '0'";
            $stmt2 = $conn->prepare($count_na);
            $stmt2->execute();
            foreach($stmt2->fetchALL() as $j){
                        echo '<tr>';

        echo '<td ><h3 style="color:red;"><b>'.$j['total'].'</b></h3></td>';
                
        echo '</tr>';
            }
         
    }
}

if ($method == 'fetch_audited_list_fas') {
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $empid =$_POST['empid'];
    $fname =$_POST['fname'];
    $esection = $_POST['esection'];
    $lname = $_POST['lname'];
    $carmaker = $_POST['carmaker'];
    $carmodel = $_POST['carmodel'];
    $section = $_POST['section'];
    $audit_type = $_POST['audit_type'];
    $position = $_POST['position'];
    $audit_categ = $_POST['audit_categ'];
    $c = 0;

    $query = "SELECT * FROM ialert_audit
    WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%'  AND line_no LIKE '$lname%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND pd IS NULL AND hr IS NULL AND section = '$section' AND audit_type LIKE '$audit_type%' AND position LIKE '$position%' AND audited_categ LIKE '$audit_categ%' 
     GROUP BY id ORDER BY date_audited ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;
        $date_audited = $x['date_audited'];
        $pd = $x['pd'];
        $hr = $x['hr'];
        $days_notif = date("Y-m-d", strtotime('+4 day',strtotime($date_audited)));
               
              if ($pd == '' && $hr == '' && $server_date_only >= $days_notif) {
                	echo '<tr style="color:red;">';
			                echo '<td>';
			                echo '<p>
			                        <label>
			                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
			                            <span></span>
			                        </label>
			                    </p>';
			                echo '</td>';
			                echo '<td>'.$c.'</td>';
			                echo '<td style="display: none;">'.$x['batch'].'</td>';
			                echo '<td>'.$x['date_audited'].'</td>';
			                echo '<td>'.$x['full_name'].'</td>';
			                echo '<td>'.$x['employee_num'].'</td>';
			                echo '<td>'.$x['position'].'</td>';
			                echo '<td>'.$x['provider'].'</td>';
			                echo '<td>'.$x['groups'].'</td>';
			                echo '<td>'.$x['car_maker'].'</td>';
			                echo '<td>'.$x['car_model'].'</td>';
			                echo '<td>'.$x['section'].'</td>';
			                echo '<td>'.$x['line_no'].'</td>';
			                echo '<td>'.$x['process'].'</td>';
			                echo '<td>'.$x['audit_findings'].'</td>';
			                echo '<td>'.$x['audit_type'].'</td>';
			                echo '<td>'.$x['audited_by'].'</td>';
			                echo '<td>'.$x['audited_categ'].'</td>';
			                echo '<td>'.$x['remarks'].'</td>';
			                echo '<td>'.$x['agency'].'</td>';
                 	echo '</tr>';
               } else{
                   	echo '<tr>';
			                echo '<td>';
			                echo '<p>
			                        <label>
			                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
			                            <span></span>
			                        </label>
			                    </p>';
			                echo '</td>';
			                echo '<td>'.$c.'</td>';
			                echo '<td style="display: none;">'.$x['batch'].'</td>';
			                echo '<td>'.$x['date_audited'].'</td>';
			                echo '<td>'.$x['full_name'].'</td>';
			                echo '<td>'.$x['employee_num'].'</td>';
			                echo '<td>'.$x['position'].'</td>';
			                echo '<td>'.$x['provider'].'</td>';
			                echo '<td>'.$x['groups'].'</td>';
			                echo '<td>'.$x['car_maker'].'</td>';
			                echo '<td>'.$x['car_model'].'</td>';
			                echo '<td>'.$x['section'].'</td>';
			                echo '<td>'.$x['line_no'].'</td>';
			                echo '<td>'.$x['process'].'</td>';
			                echo '<td>'.$x['audit_findings'].'</td>';
			                echo '<td>'.$x['audit_type'].'</td>';
			                echo '<td>'.$x['audited_by'].'</td>';
			                echo '<td>'.$x['audited_categ'].'</td>';
			                echo '<td>'.$x['remarks'].'</td>';
			                echo '<td>'.$x['agency'].'</td>';
                	echo '</tr>';
               }
               
          
    }
}else{
        echo '<tr>';
            echo '<td colspan="18" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
            }
}

// if ($method == 'update_fas') {
//     $id = [];
//     $id = $_POST['id'];
//     $status = $_POST['status'];
//     //COUNT OF ITEM TO BE UPDATED
//     $count = count($id);
//     foreach($id as $x){

   
       
//         $update = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x'";
//         $stmt2 = $conn->prepare($update);
//         if ($stmt2->execute()) {
//             // echo 'approved';
//             $count = $count - 1;
//         }else{
//             // echo 'error';
//         }
//     }

//         if($count == 0){
//             echo 'success';
//         }else{
//             echo 'fail';
        
// } 
// }


if ($method == 'update_fas') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

    		// $get_emp = "SELECT employee_num FROM ialert_audit WHERE id ='$x'";
    		// $stmt14 = $conn->prepare($get_emp);
    		// if ($stmt14->execute()) {
    		// 	foreach($stmt14->fetchALL() as $j){
    		// 		$employee_num = $j['employee_num'];

    		// 		$audit_counts = "SELECT count(audit_findings) as audit_count FROM ialert_audit WHERE employee_num = '$employee_num'";
    		// 		$stmt15 = $conn->prepare($audit_counts);
    		// 		if ($stmt15->execute()) {
    		// 			foreach($stmt15->fetchALL() as $j){
    		// 				$audit_count = $j['audit_count'];
    		// 			}
    		// 			if ($audit_count >= 3) {
    		// 				if ($status == 'IR') {
    		// 					$update11 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    		// 						$stmt16 = $conn->prepare($update11);
    		// 						if ($stmt16->execute()) {
    		// 						 	echo 'success';
    		// 						 }else{
    		// 						 	echo 'error';
    		// 						 } 
    		// 				}
    		// 			}else{
    						
    		// 			}
    		// 		}

    		// 	}
    		// }


    		$check_audit = "SELECT audit_findings FROM ialert_audit WHERE id = '$x'";
    		$stmt = $conn->prepare($check_audit);
    		if ($stmt->execute()) {
    			foreach($stmt->fetchALL() as $j){
    				 $audit_findings = $j['audit_findings'];

    				 if ($audit_findings == 'Un Authorized Repair/Hidden Repair') {
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update2 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt5 = $conn->prepare($update2);
    								if ($stmt5->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Bringing of prohibited tool'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update3 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt6 = $conn->prepare($update3);
    								if ($stmt6->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Un Authorized person doing the process'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update4 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt7 = $conn->prepare($update4);
    								if ($stmt7->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Intentional Act of making defect'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update5 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt8 = $conn->prepare($update5);
    								if ($stmt8->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Intentional Act of making defect'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update6 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt9 = $conn->prepare($update6);
    								if ($stmt9->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Pulling of inserted wire on connector to dis-insert'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update7 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt10 = $conn->prepare($update7);
    								if ($stmt10->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Non Compliance on insert-pull method'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update8 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt11 = $conn->prepare($update8);
    								if ($stmt11->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Not following dimension inspection rule'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update9 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt12 = $conn->prepare($update9);
    								if ($stmt12->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else if($audit_findings == 'Using of prohibited tool on prohibited act'){
    							if ($status != 'IR') {
    								echo 'invalid';
    							}else{
    								$update10 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt12 = $conn->prepare($update10);
    								if ($stmt12->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    							}
    						}else{
    							
    							$update11 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    								$stmt13 = $conn->prepare($update11);
    								if ($stmt13->execute()) {
    								 	echo 'success';
    								 }else{
    								 	echo 'error';
    								 } 
    						}			
    			}
    		}



    	}
}

$conn = NULL;
?>