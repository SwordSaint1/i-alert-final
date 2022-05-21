<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'fetch_line_audit_list') {
  		$dateFrom = $_POST['dateFrom'];
        $dateTo = $_POST['dateTo'];
        $line_n = $_POST['line_n'];
        $carmaker = $_POST['carmaker'];
        $carmodel = $_POST['carmodel'];
        $audit_categ = $_POST['audit_categ'];
        $c = 0;

     	$query ="SELECT * FROM ialert_line_audit WHERE  line_no LIKE '$line_n%' AND car_model LIKE '$carmodel%' AND car_maker LIKE '$carmaker%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') AND audited_categ LIKE '$audit_categ%' GROUP BY id ORDER BY date_audited ASC";

	    $stmt = $conn->prepare($query);
	    $stmt->execute();
	    if ($stmt->rowCount() > 0) {
	        foreach($stmt->fetchALL() as $x){
	        $c++;   
                 echo '<tr>';
                    echo '<td>';
                	echo '<p>
                        <label>
                            <input type="checkbox" name="" id="" class="singleCheck" value="'.$x['id'].'">
                            <span></span>
                        </label>
                    	</p>';
	                echo '</td>';
	                echo '<td >'.$c.'</td>';
	                echo '<td style="display: none;">'.$x['batch'].'</td>';
	                echo '<td>'.$x['date_audited'].'</td>';
	                echo '<td>'.$x['shift'].'</td>';
	                echo '<td>'.$x['groups'].'</td>';
	                echo '<td>'.$x['car_maker'].'</td>';
	                echo '<td>'.$x['car_model'].'</td>';
	                echo '<td>'.$x['line_no'].'</td>';
	                echo '<td>'.$x['process'].'</td>';
                 	echo '<td style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#updateline" onclick="get_set_line(&quot;'.$x['id'].'~!~'.$x['shift'].'~!~'.$x['groups'].'~!~'.$x['date_audited'].'~!~'.$x['car_maker'].'~!~'.$x['car_model'].'~!~'.$x['line_no'].'~!~'.$x['process'].'~!~'.$x['audit_findings'].'~!~'.$x['audited_by'].'~!~'.$x['audited_categ'].'~!~'.$x['remarks'].'~!~'.$x['audit_type'].'&quot;)">'.$x['audit_findings'].'</td>';
                  	echo '<td>'.$x['audited_by'].'</td>';
                  	echo '<td>'.$x['audited_categ'].'</td>';
                  	echo '<td>'.$x['audit_type'].'</td>';
                   	echo '<td>'.$x['remarks'].'</td>';
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