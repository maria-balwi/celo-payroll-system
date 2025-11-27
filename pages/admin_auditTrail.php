<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                <div>Audit Trail</div>    
            </div>
            
            <!-- CONTENT -->
            <!-- <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <! -- DATATABLE - ->
                <div class="mx-auto my-3 overflow-auto">
                    <table id="auditTrailTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            < ?php
                                // function formatDate($date) {
                                //     // Create a DateTime object from the string
                                //     $dateTime = new DateTime($date);
                                
                                //     // Format the date
                                //     return $dateTime->format('F j, Y');
                                // }

                                // $query = mysqli_query($conn, $employees->viewAuditTrail());
                                // while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                //     $auditTrailID = $auditTrailDetails['auditTrailID'];
                                //     $date = $auditTrailDetails['date'];
                                //     $employeeName = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                //     $module = $auditTrailDetails['module'];
                                //     $action = $auditTrailDetails['action'];
                                //     // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                //     if ($auditTrailDetails['affected_empID'] === null) {
                                //         $affected_user = "-";
                                //     } else {
                                //         $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                //         $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                //         $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                //     }
                                //     $date = formatDate($date);

                                //     echo "<tr>";
                                //     echo "<td class ='whitespace-nowrap'>" . $auditTrailID . "</td>";
                                //     echo "<td class ='whitespace-nowrap'>" . $date . "</td>";
                                //     echo "<td class ='whitespace-nowrap'>" . $employeeName . "</td>";
                                //     echo "<td class ='whitespace-nowrap'>" . $module . "</td>";
                                //     echo "<td class ='whitespace-nowrap'>" . $action . "</td>";
                                //     echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                //     echo "</tr>";
                                // }
                            ? >
                        </tbody>
                    </table>
                </div>
            </div> -->

            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <!--EMPLOYEE BUTTON-->
                                <button class="nav-link active uncheck" id="pills-employee-tab" data-bs-toggle="pill" data-bs-target="#pills-employee" type="button" role="tab" aria-controls="pills-employee" aria-selected="true">Employee</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--PAYROLL BUTTON-->
                                <button class="nav-link uncheck" id="pills-payroll-tab" data-bs-toggle="pill" data-bs-target="#pills-payroll" type="button" role="tab" aria-controls="pills-payroll" aria-selected="false">Payroll</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--LEAVE BUTTON-->
                                <button class="nav-link uncheck" id="pills-leave-tab" data-bs-toggle="pill" data-bs-target="#pills-leave" type="button" role="tab" aria-controls="pills-leave" aria-selected="false">Leave</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--CHANGE SHIFT BUTTON-->
                                <button class="nav-link uncheck" id="pills-changeshift-tab" data-bs-toggle="pill" data-bs-target="#pills-changeshift" type="button" role="tab" aria-controls="pills-changeshift" aria-selected="false">Change Shift</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--OVERTIME BUTTON-->
                                <button class="nav-link uncheck" id="pills-overtime-tab" data-bs-toggle="pill" data-bs-target="#pills-overtime" type="button" role="tab" aria-controls="pills-overtime" aria-selected="false">Overtime</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--ADJUSTMENTS BUTTON-->
                                <button class="nav-link uncheck" id="pills-adjustments-tab" data-bs-toggle="pill" data-bs-target="#pills-adjustments" type="button" role="tab" aria-controls="pills-adjustments" aria-selected="false">Adjustments</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--USERS BUTTON-->
                                <button class="nav-link uncheck" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users" type="button" role="tab" aria-controls="pills-users" aria-selected="false">Users</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ----------------------------------------- EMPLOYEES TAB ----------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-employee" role="tabpanel" aria-labelledby="pills-employee-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="employeesTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    function formatDate($date) {
                                                        // Create a DateTime object from the string
                                                        $dateTime = new DateTime($date);
                                                    
                                                        // Format the date
                                                        return $dateTime->format('F j, Y');
                                                    }

                                                    function formatTime($time) {
                                                        if (empty($time)) return '';
                                                        return date("h:i A", strtotime($time));
                                                    }


                                                    $query = mysqli_query($conn, $employees->viewAuditTrailEmployee());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $employeeATID = $auditTrailDetails['auditTrailID'];
                                                        $employeeDate = $auditTrailDetails['date'];
                                                        $employeeName = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $employeeModule = $auditTrailDetails['module'];
                                                        $employeeAction = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateEmployee = formatDate($employeeDate);
                                                        $timeEmployee = formatTime($employeeDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employeeATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employeeModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employeeAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------ PAYROLL TAB ------------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-payroll" role="tabpanel" aria-labelledby="pills-payroll-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="payrollTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailPayroll());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $payrollATID = $auditTrailDetails['auditTrailID'];
                                                        $payrollDate = $auditTrailDetails['date'];
                                                        $payrollEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $payrollModule = $auditTrailDetails['module'];
                                                        $payrollAction = $auditTrailDetails['action'];
                                                        $datePayroll = formatDate($payrollDate);
                                                        $timePayroll = formatTime($payrollDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payrollATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $datePayroll . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timePayroll . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payrollEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payrollModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payrollAction . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- LEAVE TAB ------------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-leave" role="tabpanel" aria-labelledby="pills-leave-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="leaveTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailLeave());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $leaveATID = $auditTrailDetails['auditTrailID'];
                                                        $leaveDate = $auditTrailDetails['date'];
                                                        $leaveEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $leaveModule = $auditTrailDetails['module'];
                                                        $leaveAction = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateLeave = formatDate($leaveDate);
                                                        $timeLeave = formatTime($leaveDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $leaveATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateLeave . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeLeave . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $leaveEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $leaveModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $leaveAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ---------------------------------------- CHANGE SHIFT TAB --------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-changeshift" role="tabpanel" aria-labelledby="pills-changeshift-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="changeShiftTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailChangeShift());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $changeShiftATID = $auditTrailDetails['auditTrailID'];
                                                        $changeShiftDate = $auditTrailDetails['date'];
                                                        $changeShiftEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $changeShiftModule = $auditTrailDetails['module'];
                                                        $changeShiftAction = $auditTrailDetails['action'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateChangeShift = formatDate($changeShiftDate);
                                                        $timeChangeShift = formatTime($changeShiftDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $changeShiftATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateChangeShift . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeChangeShift . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $changeShiftEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $changeShiftModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $changeShiftAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------ OVERTIME TAB ----------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-overtime" role="tabpanel" aria-labelledby="pills-overtime-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="overtimeTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailOvertime());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $overtimeATID = $auditTrailDetails['auditTrailID'];
                                                        $overtimeDate = $auditTrailDetails['date'];
                                                        $overtimeEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $overtimeModule = $auditTrailDetails['module'];
                                                        $overtimeAction = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateOvertime = formatDate($overtimeDate);
                                                        $timeOvertime = formatTime($overtimeDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $overtimeATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateOvertime . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeOvertime . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $overtimeEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $overtimeModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $overtimeAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ----------------------------------------- ADJUSTMENTS TAB --------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-adjustments" role="tabpanel" aria-labelledby="pills-adjustments-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="adjustmentsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailAdjustments());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $adjustmentATID = $auditTrailDetails['auditTrailID'];
                                                        $adjustmentDate = $auditTrailDetails['date'];
                                                        $adjustmentEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $adjustmentModule = $auditTrailDetails['module'];
                                                        $adjustmentAction = $auditTrailDetails['action'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateAdjustment = formatDate($adjustmentDate);
                                                        $timeAdjustment = formatTime($adjustmentDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateAdjustment . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeAdjustment . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- USERS TAB ------------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="usersTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailUsers());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $usersATID = $auditTrailDetails['auditTrailID'];
                                                        $usersDate = $auditTrailDetails['date'];
                                                        $usersEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $usersModule = $auditTrailDetails['module'];
                                                        $usersAction = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateUsers = formatDate($usersDate);
                                                        $timeUsers = formatTime($usersDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $usersATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateUsers . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeUsers . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $usersEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $usersModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $usersAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/admin_auditTrail.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>