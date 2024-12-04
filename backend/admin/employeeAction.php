<?php 

    include '../../init.php';
    $conn = $database->dbConnect();
    session_start();

    $id = $_POST['id_employee'];

    if (isset($_POST['action']) && $_POST['action'] == "resign") {
        mysqli_query($conn, $employees->resignEmployee($id));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Employee List";
        $at_action = "Resigned Employee";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

        $em = "Employee Resigned Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }
    else if (isset($_POST['action']) && $_POST['action'] == "rehire") {
        mysqli_query($conn, $employees->rehireEmployee($id));

        // AUDIT TRAIL
        $at_empID = $_SESSION['id'];
        $at_module = "Admin - Employee List";
        $at_action = "Rehired Employee";
        mysqli_query($conn, $employees->auditTrail($at_empID, $at_module, $at_action, $id));

        $em = "Employee Rehired Successfully";
        $error = array('error' => 0, 'em' => $em);
        echo json_encode($error);
    }

    exit();
?>