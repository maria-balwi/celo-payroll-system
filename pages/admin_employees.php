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
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-body">
                        <!-- DATATABLE -->
                        <div class="container mx-auto overflow-auto">
                            <table id="employeeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-2">
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
                                        $employeeQuery = mysqli_query($conn, $employees->viewEmployees());
                                        while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                            $employee_id = $employeeDetails['id'];
                                            $employee_employeeID = $employeeDetails['employeeID'];
                                            $employee_employeeName = $employeeDetails['firstName'] . " " . $employeeDetails['lastName'];
                                            $employee_emailAddress = $employeeDetails['emailAddress'];
                                            $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                            $employee_department = $employeeDetails['departmentName'];


                                            echo "<tr data-id='" . $employee_id . "' class='employeeView cursor-pointer'>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_employeeID . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_department . "</td>";
                                            echo "</td>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                    </div>
                </div>
            </div>

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------------- ADD EMPLOYEE FORM ------------------------------------------------------->
            <form id="addEmployeeForm">
                <div class="modal fade" id="addEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-lg modal-dialog-centered">
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

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <label for="lastName">Last Name:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="firstName">First Name:</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="gender">Gender:</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="civilStatus">Civil Status:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                    </div>
                                    <div class="col-2">
                                        <select id="gender" name="gender" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
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
                                
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label for="address">Address:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="dateOfBirth">Date of Birth:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="placeOfBirth">Place of Birth:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="Date of Birth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" placeholder="Place of Birth">
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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
                                        <input type="text" class="form-control" id="sss" name="sss" placeholder ="SSS">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="pagIbig" name="pagIbig" placeholder="Pag-Ibig">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="philhealth" name="philhealth" placeholder="PhilHealth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="tin" name="tin" placeholder="TIN">
                                    </div>
                                </div>

                                <hr>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Work Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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
                                        <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="employeeID" name="employeeID" placeholder="Employee ID">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Mobile Number">
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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

                                <div class="row g-2 mb-2">
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
                                        <input type="number" class="form-control" id="basicPay" name="basicPay" placeholder="Basic Pay">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="dailyRate" name="dailyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="hourlyRate" name="hourlyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <label for="vacationLeaves">Vacation Leaves:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="sickLeaves">Sick Leaves:</label>
                                    </div>
                                </div>
                            
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="vacationLeaves" name="vacationLeaves" placeholder="Vacation Leaves">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="sickLeaves" name="sickLeaves" placeholder="Sick Leaves">
                                    </div>
                                </div>

                                <h2 class="text-lg font-semibold">Requirements:</h2>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <!-- SSS -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_sss" name="req_sss">
                                            <label class="form-check-label" for="req_sss">
                                                SSS
                                            </label>
                                        </div>
                                        <!-- PAG-IBIG -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_pagIbig" name="req_pagIbig">
                                            <label class="form-check-label" for="req_pagIbig">
                                                Pag-Ibig
                                            </label>
                                        </div>
                                        <!-- PHILHEALTH -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_philhealth" name="req_philhealth">
                                            <label class="form-check-label" for="req_philhealth">
                                                PhilHealth
                                            </label>
                                        </div>
                                        <!-- TIN -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="req_tin" name="req_tin">
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
            <!------------------------------------------------------------------ VIEW EMPLOYEE FORM ------------------------------------------------------->
            <div class="modal fade" id="viewEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-scrollable">
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

                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <label for="viewLastName">Last Name:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewFirstName">First Name:</label>
                                </div>
                                <div class="col-2">
                                    <label for="viewGender">Gender:</label>
                                </div>
                                <div class="col-2">
                                    <label for="viewCivilStatus">Civil Status:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewLastName" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewFirstName" disabled readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="viewGender" disabled readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="viewCivilStatus" disabled readonly>
                                </div>
                            </div>     
                            
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <label for="viewAddress">Address:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewDateOfBirth">Date of Birth:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewPlaceOfBirth">Place of Birth:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewAddress" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="date" class="form-control" id="viewDateOfBirth" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewPlaceOfBirth" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
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

                            <div class="row g-2 mb-2">
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

                            <div class="row g-2 mb-2">
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

                            <div class="row g-2 mb-2">
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

                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <label for="viewVacationLeaves">Vacation Leaves:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewSickLeaves">Sick Leaves:</label>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewVacationLeaves" name="viewVacationLeaves" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="viewSickLeaves" name="viewSickLeaves" disabled readonly>
                                </div>
                            </div>

                            <h2 class="text-lg font-semibold">Requirements:</h2>
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary employeeUpdate">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------- UPDATE EMPLOYEE FORM ------------------------------------------------------->
            <form id="updateEmployeeForm">
                <div class="modal fade" id="updateEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="employeeFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-lg modal-dialog-centered modal-scrollable">
                        <div class="modal-content" id="updateEmployeeModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="employeeFormLabel">New Employee</h1>
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

                                <div class="row g-2 mb-2">
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
                                        <input type="text" class="form-control" id="updateLastName" name="updateLastName" placeholder="Name">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateFirstName" name="updateFirstName" placeholder="Name">
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
                                
                                <div class="row g-2 mb-2">
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
                                        <input type="text" class="form-control" id="updateAddress" name="updateAddress" placeholder="Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="form-control" id="updateDateOfBirth" name="updateDateOfBirth" placeholder="Date of Birth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePlaceOfBirth" name="updatePlaceOfBirth" placeholder="Place of Birth">
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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
                                        <input type="text" class="form-control" id="updateSSS" name="updateSSS"  placeholder="SSS">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePagIbig" name="updatePagIbig" placeholder="Pag-Ibig">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updatePhilhealth" name="updatePhilhealth" placeholder="PhilHealth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateTIN" name="updateTIN" placeholder="TIN">
                                    </div>
                                </div>

                                <hr>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <h2 class="text-xl font-bold">Work Information</h2>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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
                                        <input type="email" class="form-control" id="updateEmailAddress" name="updateEmailAddress" placeholder="Email Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateEmployeeID" name="updateEmployeeID" placeholder="Employee ID">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="updateMobileNumber" name="updateMobileNumber" placeholder="Mobile Number">
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
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

                                <div class="row g-2 mb-2">
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
                                        <input type="number" class="form-control" id="updateBasicPay" name="updateBasicPay" placeholder="Basic Pay">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateDailyRate" name="updateDailyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateHourlyRate" name="updateHourlyRate" placeholder="1.0" step="0.01" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <label for="updateVacationLeaves">Vacation Leaves:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateSickLeaves">Sick Leaves:</label>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateVacationLeaves" name="updateVacationLeaves">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" id="updateSickLeaves" name="updateSickLeaves">
                                    </div>
                                </div>

                                <h2 class="text-lg font-semibold">Requirements:</h2>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <!-- SSS -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_sss" name="update_req_sss" value="update_req_sss">
                                            <label class="form-check-label" for="update_req_sss">
                                                SSS
                                            </label>
                                        </div>
                                        <!-- PAG-IBIG -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_pagIbig" name="update_req_pagIbig" value="update_req_pagIbig">
                                            <label class="form-check-label" for="update_req_pagIbig">
                                                Pag-Ibig
                                            </label>
                                        </div>
                                        <!-- PHILHEALTH -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_philhealth" name="update_req_philhealth" value="update_req_philhealth">
                                            <label class="form-check-label" for="update_req_philhealth">
                                                PhilHealth
                                            </label>
                                        </div>
                                        <!-- TIN -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_req_tin" name="update_req_tin" value="update_req_tin">
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
        </main>
    
        <script src="../assets/js/admin_employees.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>