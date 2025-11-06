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
                    Employees
                </div>  
                <input type="hidden" id="adminID" name="adminID" value="<?php echo $_SESSION['designationID']; ?>">  
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <!--ACTIVE BUTTON-->
                                <button class="nav-link active uncheck" id="pills-current-tab" data-bs-toggle="pill" data-bs-target="#pills-current" type="button" role="tab" aria-controls="pills-current" aria-selected="true">Active</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--RESIGNED BUTTON-->
                                <button class="nav-link uncheck" id="pills-resigned-tab" data-bs-toggle="pill" data-bs-target="#pills-resigned" type="button" role="tab" aria-controls="pills-resigned" aria-selected="false">Resigned</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------- ACTIVE EMPLOYEES TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-current" role="tabpanel" aria-labelledby="pills-current-tab">
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
                                                    $employeeQuery = mysqli_query($conn, $employees->viewActiveEmployees());
                                                    while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                                        $employee_id = $employeeDetails['id'];
                                                        $employee_employeeID = $employeeDetails['employeeID'];
                                                        $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                                        $employee_emailAddress = $employeeDetails['emailAddress'];
                                                        $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                                        $employee_department = $employeeDetails['departmentName'];


                                                        echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
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
                            <!-- ------------------------------------- RESIGNED EMPLOYEES TAB ------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-resigned" role="tabpanel" aria-labelledby="pills-resigned-tab">
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

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------- ADD EMPLOYEE FORM ------------------------------------------------------->
            <form id="addEmployeeForm" enctype="multipart/form-data">
                <div class="modal fade" id="addEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-xl modal-dialog-centered">
                        <div class="modal-content" id="addEmployeeModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New Employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Personal Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 align-items-end">
                                    <div class="col-2 d-flex justify-content-center align-items-end">
                                        <div id="photoContainer" class="position-relative w-100" style="height: 150px;">
                                            <!-- Profile photo -->
                                            <img id="previewPhoto"
                                                alt="Profile Photo"
                                                src=""
                                                class="rounded position-absolute top-0 start-0 w-100 h-100"
                                                style="object-fit: cover; display: none; z-index: 2;">

                                            <!-- Placeholder -->
                                            <div id="photoPlaceholder"
                                                class="d-flex align-items-center justify-content-center border rounded bg-light text-muted position-absolute top-0 start-0 w-100 h-100"
                                                style="z-index: 1;">
                                            Photo
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right side content (name, gender, civil status, etc.) -->
                                    <div class="col-10">
                                        <!-- Row 1 -->
                                        <div class="row g-2 mb-2">
                                            <div class="col-4">
                                                <label for="lastName">Last Name:</label>
                                                <input type="text" class="form-control" id="lastName" name="lastName">
                                            </div>
                                            <div class="col-4">
                                                <label for="firstName">First Name:</label>
                                                <input type="text" class="form-control" id="firstName" name="firstName">
                                            </div>
                                            <div class="col-2">
                                                <label for="gender">Gender:</label>
                                                <select id="gender" name="gender" class="form-select">
                                                    <option value="" selected disabled>Choose</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label for="civilStatus">Civil Status:</label>
                                                <select id="civilStatus" name="civilStatus" class="form-select">
                                                    <option selected disabled>Choose</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!-- Row 2 -->
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label for="address">Address:</label>
                                                <input type="text" class="form-control" id="address" name="address">
                                            </div>
                                            <div class="col-2">
                                                <label for="dateOfBirth">Date of Birth:</label>
                                                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth">
                                            </div>
                                            <div class="col-4">
                                                <label for="placeOfBirth">Place of Birth:</label>
                                                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-2">
                                        <label for="photo">Upload Photo:</label>
                                    </div>
                                </div>

                                <div class="row mb-2 g-2">
                                    <div class="col-4">
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-3">
                                        <label for="sss">SSS:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="pagIbig">Pag-Ibig:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="philhealth">PhilHealth:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="tin">TIN:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="sss" name="sss">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="pagIbig" name="pagIbig">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="philhealth" name="philhealth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="tin" name="tin">
                                    </div>
                                </div>

                                <hr>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Work Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="emailAddress">Email Address:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="employeeID">Employee ID:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="mobileNumber">Mobile Number:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="employeeID" name="employeeID">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="department">Department:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="designation">Designation:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="shiftID">Shift:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <select class="form-select" id="department" name="department">
                                            <option value="" selected disabled>Choose</option>
                                            <?php
                                                $department = mysqli_query($conn, $employees->viewDepartment());
                                                while ($departmentResult = mysqli_fetch_array($department)) {
                                                ?>
                                                <option value="<?php echo $departmentResult['departmentID']; ?>">
                                                    <?php echo $departmentResult['departmentName']; ?>
                                                </option>
                                                
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select" id="designation" name="designation">
                                            <option selected disabled>Choose Department First</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select type="dropdown" id="shiftID" name="shiftID" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <?php
                                                $shift = mysqli_query($conn, $employees->viewShifts());
                                                while ($shiftResult = mysqli_fetch_array($shift)) {
                                                ?>
                                                <option value="<?php echo $shiftResult['shiftID']; ?>">
                                                    <?php echo $shiftResult['startTime'] . " - " . $shiftResult['endTime']; ?>
                                                </option>
                                                
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="basicPay">Basic Pay:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="dailyRate">Daily Rate:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="hourlyRate">Hourly Rate:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="basicPay" name="basicPay">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="dailyRate" name="dailyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="hourlyRate" name="hourlyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="employmentStatus">Employment Status:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="dateHired">Date Hired:</label>
                                    </div>
                                    <div class="col-4 dateRegularizedLabel">
                                        <label for="dateRegularized">Date Regularized:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <select id="employmentStatus" name="employmentStatus" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Probationary">Probationary</option>
                                            <option value="Regular">Regular</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="date" class="form-control" id="dateHired" name="dateHired">
                                    </div>
                                    <div class="col-4 dateRegularizedLabel">
                                        <input type="date" class="form-control" id="dateRegularized" name="dateRegularized" disabled>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-2">
                                        <label for="vacationLeaves">Vacation Leaves:</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="sickLeaves">Sick Leaves:</label>
                                    </div>
                                    <div class="col-2">
                                        
                                    </div>
                                    <div class="col-6">
                                        <label for="weekOff">Week Off:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-2">
                                        <input type="number" class="form-control" id="vacationLeaves" name="vacationLeaves">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" class="form-control" id="sickLeaves" name="sickLeaves">
                                    </div>
                                    <div class="col-2">
                                        
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="sun" value="">
                                            <label class="form-check-label" for="sun">Sun</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="mon" value="">
                                            <label class="form-check-label" for="mon">Mon</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="tue" value="">
                                            <label class="form-check-label" for="tue">Tue</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="wed" value="">
                                            <label class="form-check-label" for="wed">Wed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="thu" value="">
                                            <label class="form-check-label" for="thu">Thu</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="fri" value="">
                                            <label class="form-check-label" for="fri">Fri</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="sat" value="">
                                            <label class="form-check-label" for="sat">Sat</label>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="text-lg font-semibold mb-0">Requirements:</h2>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <!-- SSS -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_sss" name="req_sss" disabled>
                                            <label class="form-check-label" for="req_sss">
                                                SSS
                                            </label>
                                        </div>
                                        <!-- PAG-IBIG -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_pagIbig" name="req_pagIbig" disabled>
                                            <label class="form-check-label" for="req_pagIbig">
                                                Pag-Ibig
                                            </label>
                                        </div>
                                        <!-- PHILHEALTH -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_philhealth" name="req_philhealth" disabled>
                                            <label class="form-check-label" for="req_philhealth">
                                                PhilHealth
                                            </label>
                                        </div>
                                        <!-- TIN -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_tin" name="req_tin" disabled>
                                            <label class="form-check-label" for="req_tin">
                                                TIN
                                            </label>
                                        </div>
                                        <!-- NBI CLEARANCE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_nbi" name="req_nbi">
                                            <label class="form-check-label" for="req_nbi">
                                                NBI Clearance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- MEDICAL EXAM -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_medicalExam" name="req_medicalExam">
                                            <label class="form-check-label" for="req_medicalExam">
                                                Medical Exam
                                            </label>
                                        </div>
                                        <!-- 2x2 PICTURE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_2x2pic" name="req_2x2pic">
                                            <label class="form-check-label" for="req_2x2pic">
                                                2x2 Picture
                                            </label>
                                        </div>
                                        <!-- VACCINE CARD -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_vaccineCard" name="req_vaccineCard">
                                            <label class="form-check-label" for="req_vaccineCard">
                                                Vaccine Card
                                            </label>
                                        </div>
                                        <!-- PSA - BIRTH CERTIFICATE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_psa" name="req_psa">
                                            <label class="form-check-label" for="req_psa">
                                                PSA - Birth Certificate
                                            </label>
                                        </div>
                                        <!-- VALID IDs -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_validID" name="req_validID">
                                            <label class="form-check-label" for="req_validID">
                                                2 Valid IDs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- HELLO MONEY AUB ACC NUM -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_helloMoney" name="req_helloMoney">
                                            <label class="form-check-label" for="req_helloMoney">
                                                Account Number in Hello Money (AUB)
                                            </label>
                                        </div>
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
            <!----------------------------------------------------------- VIEW ACTIVE EMPLOYEE FORM ------------------------------------------------------->
            <div class="modal fade" id="viewEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-xl modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewEmployeModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Employee</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col-6">
                                    <h2 class="text-xl font-bold">Personal Information</h2>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2 align-items-end">
                                <!-- Profile Photo (occupies 2 rows visually) -->
                                <div class="col-2 d-flex justify-content-centerv align-items-end">
                                    <img id="viewProfilePhoto" 
                                        src="default_photo.jpg" 
                                        alt="Profile Photo" 
                                        class="img-thumbnail rounded" 
                                        style="width: 100%; height: 150px; object-fit: cover;">
                                </div>

                                <!-- Right side content (name, gender, civil status, etc.) -->
                                <div class="col-10">
                                    <!-- Row 1 -->
                                    <div class="row g-2 mb-2">
                                        <div class="col-4">
                                            <label for="viewLastName" class="form-label">Last Name:</label>
                                            <input type="text" class="form-control" id="viewLastName" disabled readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="viewFirstName" class="form-label">First Name:</label>
                                            <input type="text" class="form-control" id="viewFirstName" disabled readonly>
                                        </div>
                                        <div class="col-2">
                                            <label for="viewGender" class="form-label">Gender:</label>
                                            <input type="text" class="form-control" id="viewGender" disabled readonly>
                                        </div>
                                        <div class="col-2">
                                            <label for="viewCivilStatus" class="form-label">Civil Status:</label>
                                            <input type="text" class="form-control" id="viewCivilStatus" disabled readonly>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label for="viewAddress" class="form-label">Address:</label>
                                            <input type="text" class="form-control" id="viewAddress" disabled readonly>
                                        </div>
                                        <div class="col-2">
                                            <label for="viewDateOfBirth" class="form-label">Date of Birth:</label>
                                            <input type="date" class="form-control" id="viewDateOfBirth" disabled readonly>
                                        </div>
                                        <div class="col-4">
                                            <label for="viewPlaceOfBirth" class="form-label">Place of Birth:</label>
                                            <input type="text" class="form-control" id="viewPlaceOfBirth" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-3">
                                    <label for="viewsss">SSS:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewpagIbig">Pag-Ibig:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewphilhealth">PhilHealth:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewtin">TIN:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewsss" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewpagIbig" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewphilhealth" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewtin" disabled readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row g-2">
                                <div class="col-6">
                                    <h2 class="text-xl font-bold">Work Information</h2>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="viewEmailAddress">Email Address:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewMobileNumber">Mobile Number:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="email" class="form-control" id="viewEmailAddress" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewMobileNumber" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="viewDepartment">Department:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewDesignation">Designation:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewShiftID">Shift:</label>
                                </div>
                            </div>
                        
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewDepartment" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewDesignation" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewShiftID" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="viewBasicPay">Basic Pay:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewDailyRate">Daily Rate:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewHourlyRate">Hourly Rate:</label>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewBasicPay" name="viewBasicPay" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewDailyRate" name="viewDailyRate" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewHourlyRate" name="viewHourlyRate" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="viewEmploymentStatus">Employment Status:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewDateHired">Date Hired:</label>
                                </div>
                                <div class="col-4 viewDateRegularizedLabel">
                                    <label for="viewDateRegularized">Date Regularized:</label>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewEmploymentStatus" name="viewEmploymentStatus" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewDateHired" name="viewDateHired" disabled readonly>
                                </div>
                                <div class="col-4 viewDateRegularizedLabel">
                                    <input type="text" class="form-control" id="viewDateRegularized" name="viewDateRegularized" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="viewVacationLeaves">Vacation Leaves:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewSickLeaves">Sick Leaves:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewLeavePoints">Leave Points:</label>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="number" class="form-control " id="viewVacationLeaves" name="viewVacationLeaves" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewSickLeaves" name="viewSickLeaves" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewLeavePoints" name="viewLeavePoints" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4 cashAdvancePart">
                                    <label for="viewCashAdvance">Cash Advance:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-4 cashAdvancePart">
                                    <input type="number" class="form-control" id="viewCashAdvance" name="viewCashAdvance" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <button id="viewProfilePicture" class="text-lg text-blue-500">View Photo</button>
                                </div>
                            </div>

                            <h2 class="text-lg font-semibold mb-0">Requirements:</h2>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <!-- SSS -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_sss" name="view_req_sss" value="view_req_sss" disabled readonly>
                                        <label class="form-check-label" for="view_req_sss">
                                            SSS
                                        </label>
                                    </div>
                                    <!-- PAG-IBIG -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_pagIbig" name="view_req_pagIbig" value="view_req_pagIbig" disabled readonly>
                                        <label class="form-check-label" for="view_req_pagIbig">
                                            Pag-Ibig
                                        </label>
                                    </div>
                                    <!-- PHILHEALTH -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_philhealth" name="view_req_philhealth" value="view_req_philhealth" disabled readonly>
                                        <label class="form-check-label" for="view_req_philhealth">
                                            PhilHealth
                                        </label>
                                    </div>
                                    <!-- TIN -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_tin" name="view_req_tin" value="view_req_tin" disabled readonly>
                                        <label class="form-check-label" for="view_req_tin">
                                            TIN
                                        </label>
                                    </div>
                                    <!-- NBI CLEARANCE -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_nbi" name="view_req_nbi" value="view_req_nbi" disabled readonly>
                                        <label class="form-check-label" for="view_req_nbi">
                                            NBI Clearance
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!-- MEDICAL EXAM -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_medicalExam" name="view_req_medicalExam" value="view_req_medicalExam" disabled readonly>
                                        <label class="form-check-label" for="view_req_medicalExam">
                                            Medical Exam
                                        </label>
                                    </div>
                                    <!-- 2x2 PICTURE -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_2x2pic" name="view_req_2x2pic" value="view_req_2x2pic" disabled readonly>
                                        <label class="form-check-label" for="view_req_2x2pic">
                                            2x2 Picture
                                        </label>
                                    </div>
                                    <!-- VACCINE CARD -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_vaccineCard" name="view_req_vaccineCard" value="view_req_vaccineCard" disabled readonly>
                                        <label class="form-check-label" for="view_req_vaccineCard">
                                            Vaccine Card
                                        </label>
                                    </div>
                                    <!-- PSA BIRT CERTIFICATE -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_psa" name="view_req_psa" value="view_req_psa" disabled readonly>
                                        <label class="form-check-label" for="view_req_psa">
                                            PSA - Birth Certificate
                                        </label>
                                    </div>
                                    <!-- 2 VALID IDs -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_validID" name="view_req_validID" value="view_req_validID" disabled readonly>
                                        <label class="form-check-label" for="view_req_validID">
                                            2 Valid IDs
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!-- HELLO MONEY AUB ACC NUM -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="view_req_helloMoney" name="view_req_helloMoney" value="view_req_helloMoney" disabled readonly>
                                        <label class="form-check-label" for="view_req_helloMoney">
                                            Account Number in Hello Money (AUB)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="allAdjustmentsSection">
                            
                            <input type="hidden" id="viewID" name="viewID">
                            <div class="row g-2 mb-2 allAdjustmentsSection">
                                <div class="flex space-x-4">
                                    <!-- ALLOWANCES -->
                                    <div class="flex-1 bg-lightblue p-2 border border-gray-300">
                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-2 px-1">
                                                <h2 class="text-lg font-semibold">Allowances</h2>
                                                <button class="bg-blue-500 p-2 rounded" data-bs-toggle="modal" data-bs-target="#allowanceModal">
                                                    <svg class="h-5 w-5 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="space-y-2" id="allowancesSection">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DEDUCTIONS -->
                                    <div class="flex-1 bg-lightblue p-2 border border-gray-300">
                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-2 px-1">
                                                <h2 class="text-lg font-semibold">Deductions</h2>
                                                <button class="bg-blue-500 p-2 rounded" data-bs-toggle="modal" data-bs-target="#deductionModal">
                                                    <svg class="h-5 w-5 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="space-y-2" id="deductionsSection">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 allAdjustmentsSection">
                                <div class="flex space-x-4">
                                    <!-- REIMBURSEMENTS -->
                                    <div class="flex-1 bg-lightblue p-2 border border-gray-300">
                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-2 px-1">
                                                <h2 class="text-lg font-semibold">Reimbursements</h2>
                                                <button class="bg-blue-500 p-2 rounded" data-bs-toggle="modal" data-bs-target="#reimbursementModal">
                                                    <svg class="h-5 w-5 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="space-y-2" id="reimbursementsSection">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ADJUSTMENT/S +,- -->
                                    <div class="flex-1 bg-lightblue p-2 border border-gray-300">
                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-2 px-1">
                                                <h2 class="text-lg font-semibold">Adjustment/s +,- </h2>
                                                <button class="bg-blue-500 p-2 rounded" data-bs-toggle="modal" data-bs-target="#adjustmentModal">
                                                    <svg class="h-5 w-5 text-gray-100"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="space-y-2" id="adjustmentsSection">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary employeeUpdate" id="btnUpdateEmployee">Update</button>
                            <button type="button" class="btn btn-danger employeeResign" id="btnResignEmployee">Resign</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------- VIEW RESIGNED EMPLOYEE FORM ----------------------------------------------------->
            <div class="modal fade" id="viewResignedModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-scrollable">
                    <div class="modal-content" id="viewResignedModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Resigned Employee</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col-6">
                                    <h2 class="text-xl font-bold">Personal Information</h2>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="res_viewLastName">Last Name:</label>
                                </div>
                                <div class="col-4">
                                    <label for="res_viewFirstName">First Name:</label>
                                </div>
                                <div class="col-2">
                                    <label for="res_viewGender">Gender:</label>
                                </div>
                                <div class="col-2">
                                    <label for="res_viewCivilStatus">Civil Status:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="res_viewLastName" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="res_viewFirstName" disabled readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="res_viewGender" disabled readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="res_viewCivilStatus" disabled readonly>
                                </div>
                            </div>     
                            
                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="res_viewAddress">Address:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewDateOfBirth">Date of Birth:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewPlaceOfBirth">Place of Birth:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="res_viewAddress" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" id="res_viewDateOfBirth" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewPlaceOfBirth" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-3">
                                    <label for="res_viewsss">SSS:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewpagIbig">Pag-Ibig:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewphilhealth">PhilHealth:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewtin">TIN:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewsss" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewpagIbig" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewphilhealth" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewtin" disabled readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row g-2">
                                <div class="col-6">
                                    <h2 class="text-xl font-bold">Work Information</h2>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-6">
                                    <label for="res_viewEmailAddress">Email Address:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-3">
                                    <label for="res_viewMobileNumber">Mobile Number:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="email" class="form-control" id="res_viewEmailAddress" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="res_viewMobileNumber" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="res_viewDepartment">Department:</label>
                                </div>
                                <div class="col-4">
                                    <label for="res_viewDesignation">Designation:</label>
                                </div>
                                <div class="col-4">
                                    <label for="res_viewEmploymentStatus">Employment Status:</label>
                                </div>
                            </div>
                        
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="res_viewDepartment" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="res_viewDesignation" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="res_viewEmploymentStatus" name="res_viewEmploymentStatus" disabled readonly>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary employeeRehire" id="btnRehireEmployee">Rehire</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnResClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- UPDATE EMPLOYEE FORM ------------------------------------------------------->
            <form id="updateEmployeeForm" enctype="multipart/form-data">
                <div class="modal fade" id="updateEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="employeeFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-scrollable">
                        <div class="modal-content" id="updateEmployeeModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="employeeFormLabel">Update Employee</h1>
                                <input type="hidden" id="updateID" name="updateID">
                                <input type="hidden" id="oldEmailAddress" name="oldEmailAddress">
                                <input type="hidden" id="oldEmployeeID" name="oldEmployeeID">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Personal Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateLastName">Last Name:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateFirstName">First Name:</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="updateGender">Gender:</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="updateCivilStatus">Civil Status:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateLastName" name="updateLastName">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateFirstName" name="updateFirstName">
                                    </div>
                                    <div class="col-2">
                                        <select id="updateGender" name="updateGender" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select id="updateCivilStatus" name="updateCivilStatus" class="form-select">
                                            <option selected disabled>Choose</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>     
                                
                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="updateAddress">Address:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updateDateOfBirth">Date of Birth:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updatePlaceOfBirth">Place of Birth:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="updateAddress" name="updateAddress">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="form-control" id="updateDateOfBirth" name="updateDateOfBirth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePlaceOfBirth" name="updatePlaceOfBirth">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-3">
                                        <label for="updateSSS">SSS:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updatePagIbig">Pag-Ibig:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updatePhilhealth">PhilHealth:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updateTIN">TIN:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateSSS" name="updateSSS">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePagIbig" name="updatePagIbig">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePhilhealth" name="updatePhilhealth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateTIN" name="updateTIN">
                                    </div>
                                </div>

                                <hr>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Work Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="updateEmailAddress">Email Address:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updateEmployeeID">Employee ID:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="updateMobileNumber">Mobile Number:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="email" class="form-control" id="updateEmailAddress" name="updateEmailAddress">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateEmployeeID" name="updateEmployeeID">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateMobileNumber" name="updateMobileNumber">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateDepartment">Department:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateDesignation">Designation:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateShiftID">Shift:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <select class="form-select" id="updateDepartment" name="updateDepartment">
                                            <option value="" selected disabled>Choose</option>
                                            <?php
                                                $department = mysqli_query($conn, $employees->viewDepartment());
                                                while ($departmentResult = mysqli_fetch_array($department)) {
                                                ?>
                                                <option value="<?php echo $departmentResult['departmentName']; ?>">
                                                    <?php echo $departmentResult['departmentName']; ?>
                                                </option>
                                                
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select" id="updateDesignation" name="updateDesignation">
                                            <option disabled selected>Choose</option>
                                            <?php
                                                $designation = mysqli_query($conn, $employees->viewDesignation());
                                                while ($designationResult = mysqli_fetch_array($designation)) {
                                                ?>
                                                <option value="<?php echo $designationResult['position']; ?>">
                                                    <?php echo $designationResult['position']; ?>
                                                </option>
                                                
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select type="dropdown" id="updateShiftID" name="updateShiftID" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <?php
                                                $shift = mysqli_query($conn, $employees->viewShifts());
                                                while ($shiftResult = mysqli_fetch_array($shift)) {
                                                ?>
                                                <option value="<?php echo $shiftResult['startTime'] . " - " . $shiftResult['endTime']; ?>">
                                                    <?php echo $shiftResult['startTime'] . " - " . $shiftResult['endTime']; ?>
                                                </option>
                                                
                                            <?php        
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateBasicPay">Basic Pay:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateDailyRate">Daily Rate:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateHourlyRate">Hourly Rate:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateBasicPay" name="updateBasicPay">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateDailyRate" name="updateDailyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateHourlyRate" name="updateHourlyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateEmploymentStatus">Employment Status:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateDateHired">Date Hired:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateDateRegularized">Date Regularized:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <select id="updateEmploymentStatus" name="updateEmploymentStatus" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Probationary">Probationary</option>
                                            <option value="Regular">Regular</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="date" class="form-control" id="updateDateHired" name="updateDateHired">
                                    </div>
                                    <div class="col-4">
                                        <input type="date" class="form-control" id="updateDateRegularized" name="updateDateRegularized">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateVacationLeaves">Vacation Leaves:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateSickLeaves">Sick Leaves:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateCashAdvance">Cash Advance:</label>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateVacationLeaves" name="updateVacationLeaves">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateSickLeaves" name="updateSickLeaves">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" step="0.001" class="form-control" id="updateCashAdvance" name="updateCashAdvance">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="updateProfilePicture">Upload Photo:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="file" id="updateProfilePicture" name="updateProfilePicture" class="form-control" accept="image/*">
                                        <img id="previewUploadPhoto" src="" alt="Selected Photo" style="display:none; max-height: 200px; margin-top: 10px;">
                                    </div>
                                    <div class="col-1 pt-2 text-left">
                                        <button id="viewUploadPhoto" disabled>
                                            <svg class="h-5 w-5 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <h2 class="text-lg font-semibold mb-0">Requirements:</h2>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <!-- SSS -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_sss" name="update_req_sss" value="update_req_sss" disabled>
                                            <label class="form-check-label" for="update_req_sss">
                                                SSS
                                            </label>
                                        </div>
                                        <!-- PAG-IBIG -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_pagIbig" name="update_req_pagIbig" value="update_req_pagIbig" disabled>
                                            <label class="form-check-label" for="update_req_pagIbig">
                                                Pag-Ibig
                                            </label>
                                        </div>
                                        <!-- PHILHEALTH -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_philhealth" name="update_req_philhealth" value="update_req_philhealth" disabled>
                                            <label class="form-check-label" for="update_req_philhealth">
                                                PhilHealth
                                            </label>
                                        </div>
                                        <!-- TIN -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_tin" name="update_req_tin" value="update_req_tin" disabled>
                                            <label class="form-check-label" for="update_req_tin">
                                                TIN
                                            </label>
                                        </div>
                                        <!-- NBI CLEARANCE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_nbi" name="update_req_nbi" value="update_req_nbi">
                                            <label class="form-check-label" for="update_req_nbi">
                                                NBI Clearance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- MEDICAL EXAM -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_medicalExam" name="update_req_medicalExam" value="update_req_medicalExam">
                                            <label class="form-check-label" for="update_req_medicalExam">
                                                Medical Exam
                                            </label>
                                        </div>
                                        <!-- 2x2 PICTURE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_2x2pic" name="update_req_2x2pic" value="update_req_2x2pic">
                                            <label class="form-check-label" for="update_req_2x2pic">
                                                2x2 Picture
                                            </label>
                                        </div>
                                        <!-- VACCINE CARD -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_vaccineCard" name="update_req_vaccineCard" value="update_req_vaccineCard">
                                            <label class="form-check-label" for="update_req_vaccineCard">
                                                Vaccine Card
                                            </label>
                                        </div>
                                        <!-- PSA BIRT CERTIFICATE -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_psa" name="update_req_psa" value="update_req_psa">
                                            <label class="form-check-label" for="update_req_psa">
                                                PSA - Birth Certificate
                                            </label>
                                        </div>
                                        <!-- 2 VALID IDs -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_validID" name="update_req_validID" value="update_req_validID">
                                            <label class="form-check-label" for="update_req_validID">
                                                2 Valid IDs
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- HELLO MONEY AUB ACC NUM -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_helloMoney" name="update_req_helloMoney" value="update_req_helloMoney">
                                            <label class="form-check-label" for="update_req_helloMoney">
                                                Account Number in Hello Money (AUB)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- ADD ALLOWANCE MODAL -------------------------------------------------------->
            <div class="modal fade" id="allowanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="allowanceModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Allowances</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        
                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <form id="allowanceForm">
                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="allowanceName">Name:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="allowanceAmount">Amount:</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <select name="allowanceName" id="allowanceName" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <?php
                                                    $allAllowances = mysqli_query($conn, $payroll->viewAllAllowances());
                                                    while ($allAllowancesResult = mysqli_fetch_array($allAllowances)) {
                                                ?>
                                                    <option value="<?php echo $allAllowancesResult['allowanceID']; ?>">
                                                        <?php echo $allAllowancesResult['allowanceName']; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" step="0.001" class="form-control" id="allowanceAmount" name="allowanceAmount">
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="allowanceType">Type:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="effectivityDate_allowance" id="effectivityDate_allowanceLabel">Effectivity Date:</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <select name="allowanceType" id="allowanceType" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <option value="1">Monthly</option>
                                                <option value="2">Semi-Monthly</option>
                                                <!-- <option value="3">Once</option> -->
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="date" class="form-control" id="effectivityDate_allowance" name="effectivityDate_allowance">
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success w-50 justify-center" id="allowanceAdd" disabled>Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-2 mb-2">
                                <table id="allowanceTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success allowanceSave">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- ADD REIMBURSEMENT MODAL ---------------------------------------------------->
            <div class="modal fade" id="reimbursementModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="reimbursementModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Reimbursements</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        
                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <form id="reimbursementForm">
                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="reimbursementName">Name:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="reimbursementAmount">Amount:</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <select name="reimbursementName" id="reimbursementName" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <?php
                                                    $allReimbursements = mysqli_query($conn, $payroll->viewAllReimbursements());
                                                    while ($allReimbursementsResult = mysqli_fetch_array($allReimbursements)) {
                                                ?>
                                                    <option value="<?php echo $allReimbursementsResult['reimbursementID']; ?>">
                                                        <?php echo $allReimbursementsResult['reimbursementName']; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" step="0.001" class="form-control" id="reimbursementAmount" name="reimbursementAmount">
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="reimbursementType">Type:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="reimbursement_oncePayrollCycleID" id="reimbursement_oncePayrollCycleIDLabel">Payroll Cycle:</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <select name="reimbursementType" id="reimbursementType" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <option value="1">Monthly</option>
                                                <option value="2">Semi-Monthly</option>
                                                <option value="3">Once</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select name="reimbursement_oncePayrollCycleID" id="reimbursement_oncePayrollCycleID" class="form-select">
                                                <option disabled selected>Select Payroll Cycle</option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, <?php echo date('Y') - 1; ?> to Jan 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, <?php echo date('Y'); ?> to Jan 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, <?php echo date('Y'); ?> to Feb 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, <?php echo date('Y'); ?> to Feb 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, <?php echo date('Y'); ?> to Mar 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, <?php echo date('Y'); ?> to Mar 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, <?php echo date('Y'); ?> to Apr 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, <?php echo date('Y'); ?> to Apr 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, <?php echo date('Y'); ?> to May 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, <?php echo date('Y'); ?> to May 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, <?php echo date('Y'); ?> to Jun 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, <?php echo date('Y'); ?> to Jun 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, <?php echo date('Y'); ?> to Jul 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, <?php echo date('Y'); ?> to Jul 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, <?php echo date('Y'); ?> to Aug 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, <?php echo date('Y'); ?> to Aug 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, <?php echo date('Y'); ?> to Sep 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, <?php echo date('Y'); ?> to Sep 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, <?php echo date('Y'); ?> to Oct 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, <?php echo date('Y'); ?> to Oct 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, <?php echo date('Y'); ?> to Nov 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, <?php echo date('Y'); ?> to Nov 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, <?php echo date('Y'); ?> to Dec 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, <?php echo date('Y'); ?> to Dec 25, <?php echo date('Y'); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success w-50 justify-center" id="reimbursementAdd" disabled>Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-2 mb-2">
                                <table id="reimbursementTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success reimbursementSave">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- ADD DEDUCTION MODAL -------------------------------------------------------->
            <div class="modal fade" id="deductionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="deductionModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Deductions</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <form id="deductionForm">
                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="deductionName">Name:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="deductionAmount">Amount:</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <select name="deductionName" id="deductionName" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <?php
                                                    $allDeductions = mysqli_query($conn, $payroll->viewAllDeductions());
                                                    while ($allDeductionsResult = mysqli_fetch_array($allDeductions)) {
                                                ?>
                                                    <option value="<?php echo $allDeductionsResult['deductionID']; ?>">
                                                        <?php echo $allDeductionsResult['deductionName']; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" step="0.001" class="form-control" id="deductionAmount" name="deductionAmount">
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="deductionType">Type:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="deduction_oncePayrollCycleID" id="deduction_oncePayrollCycleIDLabel">Payroll Cycle:</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <select name="deductionType" id="deductionType" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <option value="1">Monthly</option>
                                                <option value="2">Semi-Monthly</option>
                                                <option value="3">Once</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select name="deduction_oncePayrollCycleID" id="deduction_oncePayrollCycleID" class="form-select">
                                                <option disabled selected>Select Payroll Cycle</option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, <?php echo date('Y') - 1; ?> to Jan 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, <?php echo date('Y'); ?> to Jan 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, <?php echo date('Y'); ?> to Feb 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, <?php echo date('Y'); ?> to Feb 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, <?php echo date('Y'); ?> to Mar 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, <?php echo date('Y'); ?> to Mar 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, <?php echo date('Y'); ?> to Apr 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, <?php echo date('Y'); ?> to Apr 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, <?php echo date('Y'); ?> to May 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, <?php echo date('Y'); ?> to May 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, <?php echo date('Y'); ?> to Jun 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, <?php echo date('Y'); ?> to Jun 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, <?php echo date('Y'); ?> to Jul 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, <?php echo date('Y'); ?> to Jul 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, <?php echo date('Y'); ?> to Aug 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, <?php echo date('Y'); ?> to Aug 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, <?php echo date('Y'); ?> to Sep 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, <?php echo date('Y'); ?> to Sep 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, <?php echo date('Y'); ?> to Oct 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, <?php echo date('Y'); ?> to Oct 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, <?php echo date('Y'); ?> to Nov 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, <?php echo date('Y'); ?> to Nov 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, <?php echo date('Y'); ?> to Dec 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, <?php echo date('Y'); ?> to Dec 25, <?php echo date('Y'); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success w-50 justify-center" id="deductionAdd" disabled>Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-2 mb-2">
                                <table id="deductionTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success deductionSave">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- ADD ADJUSTMENT MODAL ------------------------------------------------------->
            <div class="modal fade" id="adjustmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="adjustmentModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">Adjustment/s</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-2 mb-2">
                                <form id="adjustmentForm">
                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="adjustmentName">Name:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="adjustmentAmount">Amount:</label>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <select name="adjustmentName" id="adjustmentName" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <?php
                                                    $allAdjustments = mysqli_query($conn, $payroll->viewAllAdjustments());
                                                    while ($allAdjustmentsResult = mysqli_fetch_array($allAdjustments)) {
                                                ?>
                                                    <option value="<?php echo $allAdjustmentsResult['adjustmentID']; ?>">
                                                        <?php echo $allAdjustmentsResult['adjustmentName']; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <input type="number" step="0.001" class="form-control" id="adjustmentAmount" name="adjustmentAmount">
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-1">
                                        <div class="col-6">
                                            <label for="adjustmentType">Type:</label>
                                        </div>
                                        <div class="col-6">
                                            <label for="adjustment_oncePayrollCycleID" id="adjustment_oncePayrollCycleIDLabel">Payroll:</label>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <select name="adjustmentType" id="adjustmentType" class="form-select">
                                                <option selected disabled>Choose</option>
                                                <option value="1">Monthly</option>
                                                <option value="2">Semi-Monthly</option>
                                                <option value="3">Once</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select name="adjustment_oncePayrollCycleID" id="adjustment_oncePayrollCycleID" class="form-select">
                                                <option disabled selected>Select Payroll Cycle</option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, <?php echo date('Y') - 1; ?> to Jan 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, <?php echo date('Y'); ?> to Jan 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, <?php echo date('Y'); ?> to Feb 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, <?php echo date('Y'); ?> to Feb 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, <?php echo date('Y'); ?> to Mar 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, <?php echo date('Y'); ?> to Mar 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, <?php echo date('Y'); ?> to Apr 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, <?php echo date('Y'); ?> to Apr 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, <?php echo date('Y'); ?> to May 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, <?php echo date('Y'); ?> to May 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, <?php echo date('Y'); ?> to Jun 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, <?php echo date('Y'); ?> to Jun 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, <?php echo date('Y'); ?> to Jul 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, <?php echo date('Y'); ?> to Jul 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, <?php echo date('Y'); ?> to Aug 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, <?php echo date('Y'); ?> to Aug 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, <?php echo date('Y'); ?> to Sep 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, <?php echo date('Y'); ?> to Sep 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, <?php echo date('Y'); ?> to Oct 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, <?php echo date('Y'); ?> to Oct 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, <?php echo date('Y'); ?> to Nov 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, <?php echo date('Y'); ?> to Nov 25, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, <?php echo date('Y'); ?> to Dec 10, <?php echo date('Y'); ?></option>
                                                <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, <?php echo date('Y'); ?> to Dec 25, <?php echo date('Y'); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mb-2">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success w-50 justify-center" id="adjustmentAdd" disabled>Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-2 mb-2">
                                <table id="adjustmentTable" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success adjustmentSave">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/admin_employees.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>