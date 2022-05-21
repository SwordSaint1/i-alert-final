<?php  
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'fetch_audited_list_fass_status') {
       $dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
        $fname =$_POST['fname'];
        $esection = $_POST['esection'];
        $lname = $_POST['lname'];
        $position = $_POST['position'];
        $carmaker = $_POST['carmaker'];
        $carmodel = $_POST['carmodel'];
        $audit_type = $_POST['audit_type']; 
        $audit_categ = $_POST['audit_categ'];
        $c = 0;

    	$query = "SELECT *,date_format(date_sent, '%Y-%m-%d %H:%i:%s') as date_sent FROM ialert_audit
    	WHERE  employee_num LIKE '$empid%' AND full_name LIKE '$fname%'  AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo')  AND provider = '$esection' AND pd IS NOT NULL AND line_no LIKE '$lname%' AND date_sent IS NULL AND position LIKE '$position%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND audit_type LIKE '$audit_type%' AND edit_count != '0' AND audited_categ LIKE '$audit_categ%' GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchALL() as $x){
        $c++;
                echo '<tr">';
	               	echo '<td>';
	                echo '<p>
	                        <label>
	                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
	                            <span></span>
	                        </label>
	                    </p>';
	                echo '</td>';
	                echo '</td>';
	                echo '<td>'.$c.'</td>';
	                echo '<td style="display: none;">'.$x['batch'].'</td>';
	                echo '<td>'.$x['date_audited'].'</td>';
	                echo '<td>'.$x['full_name'].'</td>';
	                echo '<td>'.$x['employee_num'].'</td>';
	                echo '<td>'.$x['provider'].'</td>';
	                echo '<td>'.$x['groups'].'</td>';
	                echo '<td>'.$x['car_maker'].'</td>';
	                echo '<td>'.$x['car_model'].'</td>';
	                echo '<td>'.$x['line_no'].'</td>';
	                echo '<td>'.$x['process'].'</td>';
	                echo '<td>'.$x['audit_findings'].'</td>';
	                echo '<td>'.$x['audited_by'].'</td>';
	                echo '<td>'.$x['audited_categ'].'</td>';
	                echo '<td>'.$x['remarks'].'</td>';
	                echo '<td>'.$x['pd'].'</td>';
	                echo '<td>'.$x['date_sent'].'</td>';
	                echo '<td>'.$x['hr'].'</td>';
	                echo '<td>'.$x['updated_by'].'</td>';
                echo '</tr>';        
    } 
}else{
        		echo '<tr>';
            		echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            	echo '</tr>';
            }
}

if ($method == 'update_fass') {
    $id = [];
    $id = $_POST['id'];
    $status = $_POST['status'];
    $update_by = $_POST['update_by'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $history = "INSERT INTO ialert_history (`audit_id`,`batch`,`date_audited`,`full_name`,`employee_id`,`provider`,`groups`,`carmaker`,`carmodel`,`line_no`,`process`,`audit_findings`,`audited_by`,`audit_category`,`remarks`,`pd`,`agency`,`hr`,`updated_by`,`edit_count`,`position`,`date_edited`) SELECT id, batch, date_audited, full_name, employee_num, provider, groups, car_maker, car_model, line_no, process, audit_findings, audited_by, audited_categ, remarks, pd, agency, hr, updated_by, edit_count, position, '$server_date_time' FROM ialert_audit WHERE id = '$x'";
       $stmt2 = $conn->prepare($history);
       if ($stmt2->execute()) {
           
        $update = "UPDATE ialert_audit SET pd = '$status', edit_count = edit_count - 1, updated_by = '$update_by'  WHERE id = '$x' AND edit_count > 0";
         $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
       }    
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
} 

if ($method == 'send') {
    $id = [];
    $id = $_POST['id'];
    
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){
    
    $update = "UPDATE ialert_audit SET date_sent = '$server_date_time' WHERE id = '$x' AND pd = 'IR'";
    
    $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
    }
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
} 


if ($method == 'closed') {
    $id = [];
    $id = $_POST['id'];
    $update_by = $_POST['update_by'];
    //COUNT OF ITEM TO BE UPDATED
    $count = count($id);
    foreach($id as $x){

        $history = "INSERT INTO ialert_history (`audit_id`,`batch`,`date_audited`,`full_name`,`employee_id`,`provider`,`groups`,`carmaker`,`carmodel`,`line_no`,`process`,`audit_findings`,`audited_by`,`audit_category`,`remarks`,`pd`,`agency`,`hr`,`updated_by`,`edit_count`,`position`,`date_edited`) SELECT id, batch, date_audited, full_name, employee_num, provider, groups, car_maker, car_model, line_no, process, audit_findings, audited_by, audited_categ, remarks, pd, agency, hr, updated_by, edit_count, position, '$server_date_time' FROM ialert_audit WHERE id = '$x'";
       $stmt2 = $conn->prepare($history);
       if ($stmt2->execute()) {
           
        $update = "UPDATE ialert_audit SET edit_count = 0, updated_by = '$update_by' WHERE id = '$x' AND edit_count > 0";
         $stmt = $conn->prepare($update);
        if ($stmt->execute()) {
            // echo 'approved';
            $count = $count - 1;
        }else{
            // echo 'error';
        }
       }    
        if($count == 0){
            echo 'success';
        }else{
            echo 'fail';
        }
    }
} 


$conn = NULL;
?>