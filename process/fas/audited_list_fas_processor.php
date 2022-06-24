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
    	$select = "SELECT employee_num FROM ialert_audit WHERE id = '$x'";
    	$stmt = $conn->prepare($select);
    	$stmt->execute();
    	if ($stmt->rowCount() > 0) {
    		foreach($stmt->fetchALL() as $i){
    			 $emp = $i['employee_num'];
    		}
    			$count = "SELECT count(audit_findings) as audit_count, audit_findings FROM ialert_audit WHERE employee_num = '$emp'";
    	$stmt2 = $conn->prepare($count);
    	$stmt2->execute();
    	if ($stmt2->rowCount() > 0) {
    		foreach($stmt2->fetchALL() as $o){
    		 $audit_count = $o['audit_count'];
    		 $audit_findings = $o['audit_findings'];
    		}

    		if ($audit_count >= 3) {
    				if ($status != 'IR') {
    					echo 'invalid';
    				}else{
    					$update = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x' ";
    					$stmt3 = $conn->prepare($update);
    					if ($stmt3->execute()) {
    						// echo 'success';
    						 $count = $count - 1;
    					}else{
    						echo 'error';
    					}
    				}
    		}else{
    				$check = "SELECT audit_findings FROM ialert_for_ir";
    				$stmt4 = $conn->prepare($check);
    				if ($stmt4->execute()) {
    					foreach($stmt4->fetchALL() as $p){
    						$audit_findingss = $p['audit_findings'];
    					}

    					if ($audit_findings == 'Un Authorized person doing the process') {
    						if ($status != 'IR') {
    							echo 'invalid';
    						}else{

    							if ($status == 'IR') {
    								$update2 = "UPDATE ialert_audit SET pd = '$status' WHERE id = '$x'";
    							$stmt5 = $conn->prepare($update2);
    							if ($stmt5->execute()) {
    								echo 'success';
    								 // $count = $count - 1;
    							}else{
    								echo 'error';
    							}
    							}

    							
    						}
    					}elseif($audit_findings == 'Un Authorized Repair/Hidden Repair'){
    						if ($status != 'IR') {
    							echo 'invalid';
    						}if ($status == 'IR') {
    								echo 'a';
    							
    							
    						}
    					}
    				}
    		}
    	}


    	}



    	
    	}

        // if($count == 0){
        //     echo 'success';
        // }else{
            // echo 'fail';
// }
}

$conn = NULL;
?>