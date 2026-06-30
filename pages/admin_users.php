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
                <div>
                    Users
                </div>    
                <input type="hidden" id="adminID" name="adminID" value="<?php echo $_SESSION['designationID']; ?>">  
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <!--OPERATIONS BUTTON-->
                                <button class="nav-link active uncheck" id="pills-operations-tab" data-bs-toggle="pill" data-bs-target="#pills-operations" type="button" role="tab" aria-controls="pills-operations" aria-selected="true">Operations</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--RECRUITMENT BUTTON-->
                                <button class="nav-link uncheck" id="pills-recruitment-tab" data-bs-toggle="pill" data-bs-target="#pills-recruitment" type="button" role="tab" aria-controls="pills-recruitment" aria-selected="false">Recruitment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--BUSINESS DEV BUTTON-->
                                <button class="nav-link uncheck" id="pills-business-tab" data-bs-toggle="pill" data-bs-target="#pills-business" type="button" role="tab" aria-controls="pills-business" aria-selected="false">Business Development</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--FACILITIES BUTTON-->
                                <button class="nav-link uncheck" id="pills-facilities-tab" data-bs-toggle="pill" data-bs-target="#pills-facilities" type="button" role="tab" aria-controls="pills-facilities" aria-selected="false">Facilities</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--IT BUTTON-->
                                <button class="nav-link uncheck" id="pills-it-tab" data-bs-toggle="pill" data-bs-target="#pills-it" type="button" role="tab" aria-controls="pills-it" aria-selected="false">IT</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--FINANCE BUTTON-->
                                <button class="nav-link uncheck" id="pills-finance-tab" data-bs-toggle="pill" data-bs-target="#pills-finance" type="button" role="tab" aria-controls="pills-finance" aria-selected="false">Finance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--HR BUTTON-->
                                <button class="nav-link uncheck" id="pills-hr-tab" data-bs-toggle="pill" data-bs-target="#pills-hr" type="button" role="tab" aria-controls="pills-hr" aria-selected="false">HR</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ---------------------------------------- OPERATIONS TAB ----------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-operations" role="tabpanel" aria-labelledby="pills-operations-tab">
                                <div class="card-header">
                                    <ul class="nav nav-pills card-header-pills" id="operations-role-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <!--AGENTS BUTTON-->
                                            <button class="nav-link active" id="operations-agents-tab" data-bs-toggle="pill" data-bs-target="#operations-agents" type="button" role="tab" aria-controls="operations-agents" aria-selected="true">Agents</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--TRAINER BUTTON-->
                                            <button class="nav-link" id="operations-trainer-tab" data-bs-toggle="pill" data-bs-target="#operations-trainer" type="button" role="tab" aria-controls="operations-trainer" aria-selected="false">Trainer</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--SME BUTTON-->
                                            <button class="nav-link" id="operations-sme-tab" data-bs-toggle="pill" data-bs-target="#operations-sme" type="button" role="tab" aria-controls="operations-sme" aria-selected="false">SME</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--QA BUTTON-->
                                            <button class="nav-link" id="operations-qa-tab" data-bs-toggle="pill" data-bs-target="#operations-qa" type="button" role="tab" aria-controls="operations-qa" aria-selected="false">QA</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--TL/MANAGER BUTTON-->
                                            <button class="nav-link" id="operations-tlman-tab" data-bs-toggle="pill" data-bs-target="#operations-tlman" type="button" role="tab" aria-controls="operations-tlman" aria-selected="false">TL/Manager</button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content mt-3" id="pills-tabContent">
                                    <!-- --------------- AGENTS --------------- -->
                                    <div class="tab-pane fade show active" id="operations-agents" role="tabpanel" aria-labelledby="operations-operations-tab">
                                        <div class="card border-0">
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <!--ACTIVE BUTTON-->
                                                    <button class="nav-link active" id="agents-active-tab" data-bs-toggle="pill" data-bs-target="#agents-active" type="button" role="tab" aria-controls="agents-active" aria-selected="true">Active</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <!--INACTIVE BUTTON-->
                                                    <button class="nav-link" id="agents-inactive-tab" data-bs-toggle="pill" data-bs-target="#agents-inactive" type="button" role="tab" aria-controls="agents-inactive" aria-selected="false">Inactive</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                <!-- ACTIVE AGENTS TABLE  -->
                                                <div class="tab-pane fade show active" id="agents-active" role="tabpanel" aria-labelledby="agents-active-tab">
                                                    <table id="agentsTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewPersonnel());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- INACTIVE AGENTS TABLE  -->
                                                <div class="tab-pane fade" id="agents-inactive" role="tabpanel" aria-labelledby="agents-inactive-tab">
                                                    <table id="inactiveAgentsTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewInactivePersonnel());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- -------------- TRAINER --------------- -->
                                    <div class="tab-pane fade" id="operations-trainer" role="tabpanel" aria-labelledby="operations-trainer-tab">
                                        <div class="card border-0">
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <!--ACTIVE BUTTON-->
                                                    <button class="nav-link active" id="trainer-active-tab" data-bs-toggle="pill" data-bs-target="#trainer-active" type="button" role="tab" aria-controls="trainer-active" aria-selected="true">Active</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <!--RESIGNED BUTTON-->
                                                    <button class="nav-link" id="trainer-inactive-tab" data-bs-toggle="pill" data-bs-target="#trainer-inactive" type="button" role="tab" aria-controls="trainer-inactive" aria-selected="false">Inactive</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                <!-- ACTIVE TRAINER TABLE  -->
                                                <div class="tab-pane fade show active" id="trainer-active" role="tabpanel" aria-labelledby="trainer-active-tab">
                                                    <table id="trainerTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewTrainer());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- RESIGNED TRAINER TABLE  -->
                                                <div class="tab-pane fade" id="trainer-inactive" role="tabpanel" aria-labelledby="trainer-inactive-tab">
                                                    <table id="inactiveTrainerTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewInactiveTrainer());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ---------------- SME ----------------- -->
                                    <div class="tab-pane fade" id="operations-sme" role="tabpanel" aria-labelledby="operations-sme-tab">
                                        <div class="card border-0">
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <!--ACTIVE BUTTON-->
                                                    <button class="nav-link active" id="sme-active-tab" data-bs-toggle="pill" data-bs-target="#sme-active" type="button" role="tab" aria-controls="sme-active" aria-selected="true">Active</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <!--INACTIVE BUTTON-->
                                                    <button class="nav-link" id="sme-inactive-tab" data-bs-toggle="pill" data-bs-target="#sme-inactive" type="button" role="tab" aria-controls="sme-inactive" aria-selected="false">Inactive</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                <!-- ACTIVE SME TABLE  -->
                                                <div class="tab-pane fade show active" id="sme-active" role="tabpanel" aria-labelledby="sme-active-tab">
                                                    <table id="smeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewSME());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- INACTIVE SME TABLE  -->
                                                <div class="tab-pane fade" id="sme-inactive" role="tabpanel" aria-labelledby="sme-inactive-tab">
                                                    <table id="inactiveSMETable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewInactiveSME());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- -------------- QA --------------- -->
                                    <div class="tab-pane fade" id="operations-qa" role="tabpanel" aria-labelledby="operations-qa-tab">
                                        <div class="card border-0">
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <!--ACTIVE BUTTON-->
                                                    <button class="nav-link active" id="qa-active-tab" data-bs-toggle="pill" data-bs-target="#qa-active" type="button" role="tab" aria-controls="qa-active" aria-selected="true">Active</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <!--INACTIVE BUTTON-->
                                                    <button class="nav-link" id="qa-inactive-tab" data-bs-toggle="pill" data-bs-target="#qa-inactive" type="button" role="tab" aria-controls="qa-inactive" aria-selected="false">Inactive</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                <!-- ACTIVE QA TABLE  -->
                                                <div class="tab-pane fade show active" id="qa-active" role="tabpanel" aria-labelledby="qa-active-tab">
                                                    <table id="qaTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewQA());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- INACTIVE QA TABLE  -->
                                                <div class="tab-pane fade" id="qa-inactive" role="tabpanel" aria-labelledby="qa-inactive-tab">
                                                    <table id="inactiveQATable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewInactiveQA());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ----------- TL/MANAGER ---------- -->
                                    <div class="tab-pane fade" id="operations-tlman" role="tabpanel" aria-labelledby="operations-tlman-tab">
                                        <div class="card border-0">
                                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <!--ACTIVE BUTTON-->
                                                    <button class="nav-link active" id="tlman-active-tab" data-bs-toggle="pill" data-bs-target="#tlman-active" type="button" role="tab" aria-controls="tlman-active" aria-selected="true">Active</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <!--INACTIVE BUTTON-->
                                                    <button class="nav-link" id="tlman-inactive-tab" data-bs-toggle="pill" data-bs-target="#tlman-inactive" type="button" role="tab" aria-controls="tlman-inactive" aria-selected="false">Inactive</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-2" id="pills-tabContent">
                                                <!-- ACTIVE QA TABLE  -->
                                                <div class="tab-pane fade show active" id="tlman-active" role="tabpanel" aria-labelledby="tlman-active-tab">
                                                    <table id="tlmanTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewTLMan());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                                                    echo "</td>";
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- INACTIVE QA TABLE  -->
                                                <div class="tab-pane fade" id="tlman-inactive" role="tabpanel" aria-labelledby="tlman-inactive-tab">
                                                    <table id="inactiveTLManTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            <?php
                                                                $employeeQuery = mysqli_query($conn, $employees->viewInactiveTLMan());
                                                                while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                                    $employee_id = $employeeDetails['id'];
                                                                    $employee_employeeID = $employeeDetails['employeeID'];
                                                                    $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                                    $employee_emailAddress = $employeeDetails['emailAddress'];
                                                                    $employee_mobileNumber = $employeeDetails['mobileNumber'];

                                                                    echo "<tr data-id='" . $employee_id . "' class='resignedView cursor-pointer'>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                                                    echo "<td class =' text-left whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                                                    echo "<td class ='whitespace-nowrap'>" . $employee_emailAddress . "</td>";
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
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------ RECRUITMENT TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-recruitment" role="tabpanel" aria-labelledby="pills-recruitment-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="recruitment-active-tab" data-bs-toggle="pill" data-bs-target="#recruitment-active" type="button" role="tab" aria-controls="recruitment-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="recruitment-inactive-tab" data-bs-toggle="pill" data-bs-target="#recruitment-inactive" type="button" role="tab" aria-controls="recruitment-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE RECRUITMENT TABLE  -->
                                        <div class="tab-pane fade show active" id="recruitment-active" role="tabpanel" aria-labelledby="recruitment-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="recruitmentTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $facilities = mysqli_query($conn, $employees->viewRecruitment());
                                                        while ($facilitiesDetails = mysqli_fetch_array($facilities)) {
                                                            
                                                            $userID = $facilitiesDetails['userID'];
                                                            $employeeID = $facilitiesDetails['employeeID'];
                                                            $facilitiesName = $facilitiesDetails['firstName'] . " " . $facilitiesDetails['lastName'];
                                                            $emailAdd = $facilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$facilitiesName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE RECRUITMENT TABLE  -->
                                        <div class="tab-pane fade" id="recruitment-inactive" role="tabpanel" aria-labelledby="recruitment-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveRecruitmentTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveFacilities = mysqli_query($conn, $employees->viewInactiveRecruitment());
                                                        while ($inactiveFacilitiesDetails = mysqli_fetch_array($inactiveFacilities)) {
                                                            
                                                            $userID = $inactiveFacilitiesDetails['userID'];
                                                            $employeeID = $inactiveFacilitiesDetails['employeeID'];
                                                            $inactiveFacilitiesName = $inactiveFacilitiesDetails['firstName'] . " " . $inactiveFacilitiesDetails['lastName'];
                                                            $inactiveFacilitiesEmailAdd = $inactiveFacilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveFacilitiesName."</td>";
                                                            echo "<td>".$inactiveFacilitiesEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ----------------------------------------- BUSINESS DEV TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-business" role="tabpanel" aria-labelledby="pills-business-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="business-active-tab" data-bs-toggle="pill" data-bs-target="#business-active" type="button" role="tab" aria-controls="business-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="business-inactive-tab" data-bs-toggle="pill" data-bs-target="#business-inactive" type="button" role="tab" aria-controls="business-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE BUSINESS DEV TABLE  -->
                                        <div class="tab-pane fade show active" id="business-active" role="tabpanel" aria-labelledby="business-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="businessTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $facilities = mysqli_query($conn, $employees->viewBusinessDev());
                                                        while ($facilitiesDetails = mysqli_fetch_array($facilities)) {
                                                            
                                                            $userID = $facilitiesDetails['userID'];
                                                            $employeeID = $facilitiesDetails['employeeID'];
                                                            $facilitiesName = $facilitiesDetails['firstName'] . " " . $facilitiesDetails['lastName'];
                                                            $emailAdd = $facilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$facilitiesName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE BUSINESS DEV TABLE  -->
                                        <div class="tab-pane fade" id="business-inactive" role="tabpanel" aria-labelledby="business-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveBusinessTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveFacilities = mysqli_query($conn, $employees->viewInactiveBusinessDev());
                                                        while ($inactiveFacilitiesDetails = mysqli_fetch_array($inactiveFacilities)) {
                                                            
                                                            $userID = $inactiveFacilitiesDetails['userID'];
                                                            $employeeID = $inactiveFacilitiesDetails['employeeID'];
                                                            $inactiveFacilitiesName = $inactiveFacilitiesDetails['firstName'] . " " . $inactiveFacilitiesDetails['lastName'];
                                                            $inactiveFacilitiesEmailAdd = $inactiveFacilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveFacilitiesName."</td>";
                                                            echo "<td>".$inactiveFacilitiesEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- FACILITIES TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-facilities" role="tabpanel" aria-labelledby="pills-facilities-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="facilities-active-tab" data-bs-toggle="pill" data-bs-target="#facilities-active" type="button" role="tab" aria-controls="facilities-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="facilities-inactive-tab" data-bs-toggle="pill" data-bs-target="#facilities-inactive" type="button" role="tab" aria-controls="facilities-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE RECRUITMENT TABLE  -->
                                        <div class="tab-pane fade show active" id="facilities-active" role="tabpanel" aria-labelledby="facilities-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="facilitiesTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $facilities = mysqli_query($conn, $employees->viewFacilities());
                                                        while ($facilitiesDetails = mysqli_fetch_array($facilities)) {
                                                            
                                                            $userID = $facilitiesDetails['userID'];
                                                            $employeeID = $facilitiesDetails['employeeID'];
                                                            $facilitiesName = $facilitiesDetails['firstName'] . " " . $facilitiesDetails['lastName'];
                                                            $emailAdd = $facilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$facilitiesName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE RECRUITMENT TABLE  -->
                                        <div class="tab-pane fade" id="facilities-inactive" role="tabpanel" aria-labelledby="facilities-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveFacilitiesTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveFacilities = mysqli_query($conn, $employees->viewInactiveFacilities());
                                                        while ($inactiveFacilitiesDetails = mysqli_fetch_array($inactiveFacilities)) {
                                                            
                                                            $userID = $inactiveFacilitiesDetails['userID'];
                                                            $employeeID = $inactiveFacilitiesDetails['employeeID'];
                                                            $inactiveFacilitiesName = $inactiveFacilitiesDetails['firstName'] . " " . $inactiveFacilitiesDetails['lastName'];
                                                            $inactiveFacilitiesEmailAdd = $inactiveFacilitiesDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveFacilitiesName."</td>";
                                                            echo "<td>".$inactiveFacilitiesEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- --------------------------------------------- HR TAB -------------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-hr" role="tabpanel" aria-labelledby="pills-hr-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="hr-active-tab" data-bs-toggle="pill" data-bs-target="#hr-active" type="button" role="tab" aria-controls="hr-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="hr-inactive-tab" data-bs-toggle="pill" data-bs-target="#hr-inactive" type="button" role="tab" aria-controls="hr-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE HR TABLE  -->
                                        <div class="tab-pane fade show active" id="hr-active" role="tabpanel" aria-labelledby="hr-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="hrTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $hr = mysqli_query($conn, $employees->viewHR());
                                                        while ($hrDetails = mysqli_fetch_array($hr)) {
                                                            
                                                            $userID = $hrDetails['userID'];
                                                            $employeeID = $hrDetails['employeeID'];
                                                            $hrstaffName = $hrDetails['firstName'] . " " . $hrDetails['lastName'];
                                                            $emailAdd = $hrDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$hrstaffName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE HR TABLE  -->
                                        <div class="tab-pane fade" id="hr-inactive" role="tabpanel" aria-labelledby="hr-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveHRtable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveHR = mysqli_query($conn, $employees->viewInactiveHR());
                                                        while ($inactiveHRdetails = mysqli_fetch_array($inactiveHR)) {
                                                            
                                                            $userID = $inactiveHRdetails['userID'];
                                                            $employeeID = $inactiveHRdetails['employeeID'];
                                                            $inactiveHR = $inactiveHRdetails['firstName'] . " " . $inactiveHRdetails['lastName'];
                                                            $inactiveAdminEmailAdd = $inactiveHRdetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveHR."</td>";
                                                            echo "<td>".$inactiveAdminEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- FINANCE TAB ----------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-finance" role="tabpanel" aria-labelledby="pills-finance-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="finance-active-tab" data-bs-toggle="pill" data-bs-target="#finance-active" type="button" role="tab" aria-controls="finance-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="finance-inactive-tab" data-bs-toggle="pill" data-bs-target="#finance-inactive" type="button" role="tab" aria-controls="finance-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE FINANCE TABLE  -->
                                        <div class="tab-pane fade show active" id="finance-active" role="tabpanel" aria-labelledby="finance-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="financeTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $finance = mysqli_query($conn, $employees->viewFinance());
                                                        while ($financeDetails = mysqli_fetch_array($finance)) {
                                                            
                                                            $userID = $financeDetails['userID'];
                                                            $employeeID = $financeDetails['employeeID'];
                                                            $financestaffName = $financeDetails['firstName'] . " " . $financeDetails['lastName'];
                                                            $emailAdd = $financeDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$financestaffName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE FINANCE TABLE  -->
                                        <div class="tab-pane fade" id="finance-inactive" role="tabpanel" aria-labelledby="finance-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveFinanceTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $finance = mysqli_query($conn, $employees->viewInactiveFinance());
                                                        while ($financeDetails = mysqli_fetch_array($finance)) {
                                                            
                                                            $userID = $financeDetails['userID'];
                                                            $employeeID = $financeDetails['employeeID'];
                                                            $financestaffName = $financeDetails['firstName'] . " " . $financeDetails['lastName'];
                                                            $emailAdd = $financeDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$financestaffName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- -------------------------------------------- IT TAB --------------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-it" role="tabpanel" aria-labelledby="pills-it-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="admin-active-tab" data-bs-toggle="pill" data-bs-target="#admin-active" type="button" role="tab" aria-controls="admin-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="admin-inactive-tab" data-bs-toggle="pill" data-bs-target="#admin-inactive" type="button" role="tab" aria-controls="admin-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE IT TABLE  -->
                                        <div class="tab-pane fade show active" id="admin-active" role="tabpanel" aria-labelledby="admin-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="adminTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $it = mysqli_query($conn, $employees->viewIT());
                                                        while ($adminDetails = mysqli_fetch_array($it)) {
                                                            
                                                            $userID = $adminDetails['userID'];
                                                            $employeeID = $adminDetails['employeeID'];
                                                            $itstaffName = $adminDetails['firstName'] . " " . $adminDetails['lastName'];
                                                            $itEmailAdd = $adminDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$itstaffName."</td>";
                                                            echo "<td>".$itEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE IT TABLE  -->
                                        <div class="tab-pane fade" id="admin-inactive" role="tabpanel" aria-labelledby="admin-inactive-tab">
                                            <table class="table table-striped table-bordered  pt-2" id="inactiveAdminTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveAdmin = mysqli_query($conn, $employees->viewInactiveIT());
                                                        while ($inactiveAdminDetails = mysqli_fetch_array($inactiveAdmin)) {
                                                            
                                                            $userID = $inactiveAdminDetails['userID'];
                                                            $employeeID = $inactiveAdminDetails['employeeID'];
                                                            $inactiveAdminName = $inactiveAdminDetails['firstName'] . " " . $inactiveAdminDetails['lastName'];
                                                            $inactiveAdminEmailAdd = $inactiveAdminDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveAdminName."</td>";
                                                            echo "<td>".$inactiveAdminEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------ DIRECTORS TAB ---------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- <div class="tab-pane fade" id="pills-directors" role="tabpanel" aria-labelledby="pills-directors-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <! -- ACTIVE BUTTON -- >
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="directors-active-tab" data-bs-toggle="pill" data-bs-target="#directors-active" type="button" role="tab" aria-controls="directors-active" aria-selected="true">Active</button>
                                        </li>
                                        <!- - INACTIVE BUTTON - ->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="directors-inactive-tab" data-bs-toggle="pill" data-bs-target="#directors-inactive" type="button" role="tab" aria-controls="directors-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        < !-- ACTIVE DIRECTORS TABLE  -- >
                                        <div class="tab-pane fade show active" id="directors-active" role="tabpanel" aria-labelledby="directors-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="directorsTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    < ?php
                                                        $director = mysqli_query($conn, $employees->viewDirectors());
                                                        while ($directorDetails = mysqli_fetch_array($director)) {
                                                            
                                                            $userID = $directorDetails['userID'];
                                                            $employeeID = $directorDetails['employeeID'];
                                                            $directorName = $directorDetails['firstName'] . " " . $directorDetails['lastName'];
                                                            $directorEmailAdd = $directorDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$directorName."</td>";
                                                            echo "<td>".$directorEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!- - INACTIVE DIRECTORS TABLE  -- >
                                        <div class="tab-pane fade" id="directors-inactive" role="tabpanel" aria-labelledby="directors-inactive-tab">
                                            <table class="table table-striped table-bordered  pt-2" id="inactiveDirectorsTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    < ?php
                                                        $inactiveDirector = mysqli_query($conn, $employees->viewInactiveDirectors());
                                                        while ($inactiveDirectorDetails = mysqli_fetch_array($inactiveDirector)) {
                                                            
                                                            $userID = $inactiveDirectorDetails['userID'];
                                                            $employeeID = $inactiveDirectorDetails['employeeID'];
                                                            $inactiveDirectorName = $inactiveDirectorDetails['firstName'] . " " . $inactiveDirectorDetails['lastName'];
                                                            $inactiveDirectorEmailAdd = $inactiveDirectorDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveDirectorName."</td>";
                                                            echo "<td>".$inactiveDirectorEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal" id="btnAddUser">Add User</button>
                    </div>
                </div>
            </div>


            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------- ADD USER FORM ----------------------------------------------------------->
            <form id="addUserForm">
                <div class="modal fade" id="addUserModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addUserModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New User</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="name">Name:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <select class="form-select border border-1" id="employeeID" required>
                                            <option selected disabled>Choose Employee</option>
                                            <?php
                                            $allEmployee = mysqli_query($conn, $employees->viewAllEmployee());
                                            while ($allEmployeeResult = mysqli_fetch_array($allEmployee)) {
                                            ?>
                                                <option value="<?php echo $allEmployeeResult['id']; ?>">
                                                    <?php echo $allEmployeeResult['lastName'] . ", " . $allEmployeeResult['firstName']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="password">Password:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <label for="retypePassword">Retype Password:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="retypePassword" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------ VIEW USER FORM ----------------------------------------------------------->
            <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewUserModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewUserLabel">View User</h1>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewUserID">User ID</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewUserID" disabled readonly>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewName">Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewEmployeeName" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewEmailAdd">Email</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="viewEmailAdd" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewEmployeeID">Employee ID</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewEmployeeID"disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewDepartment">Department</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewDepartment" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary userUpdate">Update</button> -->
                            <button type="button" class="btn btn-warning userResetPassword">Reset Password</button>
                            <button type="button" class="btn btn-danger userDeactivate">Deactivate</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- RESET PASSWORD FORM -------------------------------------------------------->
            <form id="resetPasswordForm">
                <div class="modal fade" id="resetPassModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="resetPassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content" id="resetPassModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="resetPassLabel">Reset Password</h1>
                                <input type="hidden" id="viewID">
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="newPass">New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="newPass" placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="retypePass">Retype New Password</label>
                                    </div>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="retypePass" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="btnSavePass">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewUserModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------ INACTIVE USERS ----------------------------------------------------------->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------ VIEW USER FORM ----------------------------------------------------------->
            <div class="modal fade" id="viewInactiveUserModal" tabindex="-1" aria-labelledby="viewInactiveUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewInactiveUserModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewInactiveUserLabel">View User</h1>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewInactiveUserID">User ID</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewInactiveUserID" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewInactiveEmployeeName">Name</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewInactiveEmployeeName" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewInactiveEmailAdd">Email</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="viewInactiveEmailAdd" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewInactiveEmpID">Employee ID</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewInactiveEmpID" disabled>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-3">
                                        <label for="viewInactiveDept">Department</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="viewInactiveDept" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary userReactivate">Reactivate</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------------------- PASSWORD CONFIRMATION FORM --------------------------------------------------->
            <form id="reactivateForm">
                <div class="modal fade" id="confirmPassModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="confirmPassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content" id="confirmPassModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="confirmPassLabel">
                                    Confirm Password
                                    <input type="hidden" id="loggedInUserPassword" value="<?php echo $_SESSION["hashedPassword"]; ?>">
                                </h1>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="reactivate_password">Enter Password</label>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <input type="password" class="form-control" id="reactivate_password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="reactivate_retypePassword">Retype Password</label>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-2">
                                        <div class="col-12">
                                            <input type="password" class="form-control" id="reactivate_retypePassword" placeholder="Retype Password">
                                        </div>
                                    </div>  
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewInactiveUserModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/admin_users.js?v=<?php echo $version; ?>"></script>
        

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>