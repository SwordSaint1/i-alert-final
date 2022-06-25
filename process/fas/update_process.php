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
    						echo 'success';
    						 // $count = $count - 1;
    					}else{
    						echo 'error';
    					}
    				}
    		}else{
    			$check = "SELECT audit_findings FROM ialert_for_ir WHERE audit_findings = '$audit_findings'";
    				$stmt4 = $conn->prepare($check);
    				if ($stmt4->execute()) {
    					foreach($stmt4->fetchALL() as $p){
    						$audit_findingss = $p['audit_findings'];						

    					}

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
    							
    							
    						}
    						
    					
    				}
    		}
    	}


    	}



    	
    	}

//         if($count == 0){
//             echo 'success';
//         }else{
//             echo 'fail';
// }
}