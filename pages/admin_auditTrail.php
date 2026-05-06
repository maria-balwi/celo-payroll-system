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
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <!--EMPLOYEE BUTTON-->
                                <button class="nav-link active uncheck" id="pills-employee-tab" data-bs-toggle="pill" data-bs-target="#pills-employee" type="button" role="tab" aria-controls="pills-employee" aria-selected="true">Employee</button>
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
                                <!--PAYROLL BUTTON-->
                                <button class="nav-link uncheck" id="pills-payroll-tab" data-bs-toggle="pill" data-bs-target="#pills-payroll" type="button" role="tab" aria-controls="pills-payroll" aria-selected="false">Payroll</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--ADJUSTMENTS BUTTON-->
                                <button class="nav-link uncheck" id="pills-adjustments-tab" data-bs-toggle="pill" data-bs-target="#pills-adjustments" type="button" role="tab" aria-controls="pills-adjustments" aria-selected="false">Salary Adjustments</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--DISPUTES BUTTON-->
                                <button class="nav-link uncheck" id="pills-disputes-tab" data-bs-toggle="pill" data-bs-target="#pills-disputes" type="button" role="tab" aria-controls="pills-disputes" aria-selected="false">Disputes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--USERS BUTTON-->
                                <button class="nav-link uncheck" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users" type="button" role="tab" aria-controls="pills-users" aria-selected="false">Users</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--MEMO BUTTON-->
                                <button class="nav-link uncheck" id="pills-memo-tab" data-bs-toggle="pill" data-bs-target="#pills-memo" type="button" role="tab" aria-controls="pills-memo" aria-selected="false">Memo</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--PASSWORD BUTTON-->
                                <button class="nav-link uncheck" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password" aria-selected="false">Password Reset</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--PAYSLIP BUTTON-->
                                <button class="nav-link uncheck" id="pills-payslip-tab" data-bs-toggle="pill" data-bs-target="#pills-payslip" type="button" role="tab" aria-controls="pills-payslip" aria-selected="false">Payslip</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--LOGIN/LOGOUT BUTTON-->
                                <button class="nav-link uncheck" id="pills-logs-tab" data-bs-toggle="pill" data-bs-target="#pills-logs" type="button" role="tab" aria-controls="pills-logs" aria-selected="false">Login/Logout</button>
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
                            <!-- -------------------------------------- SALARY ADJUSTMENTS TAB ----------------------------------- -->
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
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailSalaryAdjustments());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $adjustmentsATID = $auditTrailDetails['auditTrailID'];
                                                        $adjustmentsDate = $auditTrailDetails['date'];
                                                        $adjustmentsEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $adjustmentsModule = $auditTrailDetails['module'];
                                                        $adjustmentsAction = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateAdjustments = formatDate($adjustmentsDate);
                                                        $timeAdjustments = formatTime($adjustmentsDate);

                                                        echo "<tr data-id='{$adjustmentsATID}' class='salaryAdjustmentView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentsATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateAdjustments . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeAdjustments . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentsEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentsModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $adjustmentsAction . "</td>";
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
                            <!-- ------------------------------------------- DISPUTES TAB ---------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-disputes" role="tabpanel" aria-labelledby="pills-disputes-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="disputesTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
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
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailDisputes());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $disputesATID = $auditTrailDetails['auditTrailID'];
                                                        $disputesDate = $auditTrailDetails['date'];
                                                        $disputesEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $disputesModule = $auditTrailDetails['module'];
                                                        $disputesAction = $auditTrailDetails['action'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $dateDisputes = formatDate($disputesDate);
                                                        $timeDisputes = formatTime($disputesDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $disputesATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateDisputes . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeDisputes . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $disputesEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $disputesModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $disputesAction . "</td>";
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

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- -------------------------------------------- MEMO TAB ------------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-memo" role="tabpanel" aria-labelledby="pills-memo-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="notificationsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Notification Subject</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailMemo());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $memoATID = $auditTrailDetails['auditTrailID'];
                                                        $memoDate = $auditTrailDetails['date'];
                                                        $memoEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $memoModule = $auditTrailDetails['module'];
                                                        $memoAction = $auditTrailDetails['action'];
                                                        $memoTitle = $auditTrailDetails['title'];
                                                        $dateMemo = formatDate($memoDate);
                                                        $timeMemo = formatTime($memoDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $memoATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateMemo . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeMemo . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $memoEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $memoModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $memoAction . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $memoTitle . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- --------------------------------------- PASSWORD RESET TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="passwordResetTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
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
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailPasswordReset());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $passwordATID = $auditTrailDetails['auditTrailID'];
                                                        $passwordDate = $auditTrailDetails['date'];
                                                        $passwordEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $passwordModule = $auditTrailDetails['module'];
                                                        $passwordAction = $auditTrailDetails['action'];
                                                        $datePassword = formatDate($passwordDate);
                                                        $timePassword = formatTime($passwordDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $passwordATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $datePassword . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timePassword . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $passwordEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $passwordModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $passwordAction . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------ PAYSLIP TAB ------------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-payslip" role="tabpanel" aria-labelledby="pills-payslip-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="payslipTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
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
                                                    $query = mysqli_query($conn, $employees->viewAuditTraiLPayslip());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $payslipATID = $auditTrailDetails['auditTrailID'];
                                                        $payslipDate = $auditTrailDetails['date'];
                                                        $payslipEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $payslipModule = $auditTrailDetails['module'];
                                                        $payslipAction = $auditTrailDetails['action'];
                                                        $datePayslip = formatDate($payslipDate);
                                                        $timePayslip = formatTime($payslipDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payslipATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $datePayslip . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timePayslip . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payslipEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payslipModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $payslipAction . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ---------------------------------------- LOGIN/LOGOUT TAB --------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-logs" role="tabpanel" aria-labelledby="pills-logs-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="logsTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
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
                                                    $query = mysqli_query($conn, $employees->viewAuditTrailLoginLogout());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $logATID = $auditTrailDetails['auditTrailID'];
                                                        $logDate = $auditTrailDetails['date'];
                                                        $logEmployee = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $logModule = $auditTrailDetails['module'];
                                                        $logAction = $auditTrailDetails['action'];
                                                        $dateLog = formatDate($logDate);
                                                        $timeLog = formatTime($logDate);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $logATID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $dateLog . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $timeLog . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $logEmployee . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $logModule . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $logAction . "</td>";
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
            
            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------ VIEW SALARY ADJUSTMENT MODAL --------------------------------------------------------->
            <div class="modal fade" id="viewSalaryAdjustmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" id="viewSalaryAdjustmentModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Salary Adjustment</h1>
                            <input type="hidden" id="viewSalaryAdjustmentID">
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="viewAction">Action:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewUser">User:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewAction" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewUser" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="viewDateFiled">Date Filed:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewReason">Reason:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewDateFiled" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewReason" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewEmployeeName">Employee Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewEmployeeName" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="viewCurrentSalary">Current Salary:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewSuggestedSalary">Additional:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewCurrentSalary" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewSuggestedSalary" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose_salaryAdjustment">Close</button>
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