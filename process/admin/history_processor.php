<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'fetch_history_list') {
		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $empid =$_POST['empid'];
		$fname =$_POST['fname'];
		$line = $_POST['line'];
		$carmaker = $_POST['carmaker'];
		$carmodel = $_POST['carmodel'];
		$position = $_POST['position'];
        $c = 0;

        $query ="SELECT * FROM ialert_history WHERE employee_id LIKE '$empid%' AND full_name LIKE '$fname%' AND line_no LIKE '$line%' AND carmaker LIKE '$carmaker%' AND carmodel LIKE '$carmodel%' AND position LIKE '$position%'
     GROUP BY id ORDER BY date_audited ASC";
        $stmt =  $conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        	foreach($stmt->fetchALL() as $x){
        		$c++;
        		echo '<tr>';
        			echo '<td>'.$x['indicator_id'].'</td>';
        			echo '<td>'.$x['date_audited'].'</td>';
        			echo '<td>'.$x['full_name'].'</td>';
        			echo '<td>'.$x['employee_id'].'</td>';
        			echo '<td>'.$x['position'].'</td>';
        			echo '<td>'.$x['provider'].'</td>';
        			echo '<td>'.$x['groups'].'</td>';
        			echo '<td>'.$x['carmaker'].'</td>';
        			echo '<td>'.$x['carmodel'].'</td>';
        			echo '<td>'.$x['line_no'].'</td>';
        			echo '<td>'.$x['process'].'</td>';
        			echo '<td>'.$x['audit_findings'].'</td>';
        			echo '<td>'.$x['audited_by'].'</td>';
        			echo '<td>'.$x['audit_category'].'</td>';
        			echo '<td>'.$x['remarks'].'</td>';
        			echo '<td>'.$x['pd'].'</td>';
        			echo '<td>'.$x['agency'].'</td>';
        			echo '<td>'.$x['hr'].'</td>';
        			echo '<td>'.$x['updated_by'].'</td>';
        			echo '<td>'.$x['date_edited'].'</td>';
        		echo '</tr>';
        	}
        }else{
        	echo '<tr>';
            	echo '<td colspan="14" style="text-align:center;">NO RESULT</td>';
            echo '</tr>';
        }
}
$conn = NULL;
?>