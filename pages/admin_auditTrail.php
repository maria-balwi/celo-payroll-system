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
                                        <table id="activeEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
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

                                                    $query = mysqli_query($conn, $employees->viewAuditTrail());
                                                    while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                                        $auditTrailID = $auditTrailDetails['auditTrailID'];
                                                        $date = $auditTrailDetails['date'];
                                                        $employeeName = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                                        $module = $auditTrailDetails['module'];
                                                        $action = $auditTrailDetails['action'];
                                                        // $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                                        if ($auditTrailDetails['affected_empID'] === null) {
                                                            $affected_user = "-";
                                                        } else {
                                                            $affectedUserQuery = mysqli_query($conn, $employees->viewAffectedUser($auditTrailDetails['affected_empID']));
                                                            $affectedUserDetails = mysqli_fetch_array($affectedUserQuery);
                                                            $affected_user = $affectedUserDetails['affectedFirstName'] . " " . $affectedUserDetails['affectedLastName'];
                                                        }
                                                        $date = formatDate($date);

                                                        echo "<tr>";
                                                        echo "<td class ='whitespace-nowrap'>" . $auditTrailID . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $date . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $module . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $action . "</td>";
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
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
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
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
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
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
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
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
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
                            <div class="tab-pane fade" id="pills-leave" role="tabpanel" aria-labelledby="pills-leave-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
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
                            <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
                                <div class="card border-0">
                                    <div class="tab-content" id="pills-tabContent">
                                        <table id="resignedEmployeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php
                                                    $employeeQuery = mysqli_query($conn, $employees->viewResignedEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                        echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                                        echo "<td class ='whitespace-nowrap'>" . $employee_department . "</td>";
                                                        echo "</td>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                        </div>
                    </div>

                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addEmployeeModal" id="btnAddEmployee">Add Employee</button>
                    </div>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/admin_auditTrail.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>