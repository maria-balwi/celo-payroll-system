<?php
	include '../../init.php';
	session_start();
	$conn = $database->dbConnect();

	if (isset($_GET['audit_id'])) {
		$audit_id = mysqli_real_escape_string($conn, $_GET['audit_id']);
		$getAuditQuery = $employees->getEmployeeAuditTrail($audit_id);
		$auditTrailResult = mysqli_query($conn, $getAuditQuery);

		if ($auditTrailResult === false) {
			echo json_encode([
				'status' => 400, 
				'message' => 'Query failed',
				'sql_error' => mysqli_error($conn),
			]);
			exit;
		}
		
		$data = [];
		while ($row = mysqli_fetch_assoc($auditTrailResult)) {
			$data[] = [
				'category' => $row['category'],
				'oldData'  => $row['oldData'],
				'newData'  => $row['newData'],
			];
		}

		if (count($data) > 0) {
			echo json_encode([
				'status' => 200,
				'message' => 'Employee Audit Trail Fetch Successfully by id',
				'data' => $data
			]);
		} else {
			echo json_encode([
				'status' => 404,
				'message' => 'Employee Audit Trail ID not found'
			]);
		}
		exit;
	}

?>