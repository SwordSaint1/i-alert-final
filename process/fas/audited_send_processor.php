<?php 
	include '../conn.php';
	include '../conn2.php';
	$method = $_POST['method'];

if ($method == 'fetch_audited_list_send') {
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

    $query = "SELECT *,date_format(date_sent, '%Y-%m-%d %H:%i:%s') as date_sent FROM ialert_audit WHERE pd = 'IR' AND date_sent IS NOT NULL AND hr IS NULL AND employee_num LIKE '$empid%' AND full_name LIKE '$fname%' AND (date_audited >='$dateFrom' AND date_audited <= '$dateTo') AND provider = '$esection' AND line_no LIKE '$lname%' AND position LIKE '$position%' AND car_maker LIKE '$carmaker%' AND car_model LIKE '$carmodel%' AND audit_type LIKE '$audit_type%' AND audited_categ LIKE '$audit_categ%' GROUP BY id ORDER BY date_audited ASC";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchALL() as $x){
    $c++;         
            echo '<tr>';
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