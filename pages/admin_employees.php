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
            <div class="2xl:max-w-2xl bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="card shadow-sm bInfo">
                    <div class="card-body">
                        <!-- DATATABLE -->
                        <div class="container mx-auto overflow-auto">
                            <table id="employeeTable" class="min-w-full divide-y divide-gray-200 table-striped table-bordered">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        $employeeQuery = mysqli_query($conn, $employees->viewEmployees());
                                        while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                            $employee_id = $employeeDetails['id'];
                                            $employee_employeeName = $employeeDetails['employeeName'];
                                            $employee_emailAddress = $employeeDetails['emailAddress'];
                                            $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                            $employee_department = $employeeDetails['departmentName'];


                                            echo "<tr data-id='" . $employee_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
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
                    <div class="modal-dialog modal-none modal-xl modal-dialog-centered">
                        <div class="modal-content" id="addEmployeeModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">New Employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-6">
                                        <label for="employeeName">Name:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="gender">Gender:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="civilStatus">Civil Status:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="employeeName" placeholder="Name">
                                    </div>
                                    <div class="col-3">
                                        <select id="gender" class="form-select">
                                            <option value="" selected disabled>Choose</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select id="civilStatus" class="form-select">
                                            <option selected disabled>Choose</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>     
                                
                                <div class="row g-3 mb-2">
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

                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="address" placeholder="Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="form-control" id="dateOfBirth" placeholder="Date of Birth">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="placeOfBirth" placeholder="Place of Birth">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
                                    <div class="col-4">
                                        <label for="sss">SSS:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="pagIbig">Pag-Ibig:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="philheatlh">PhilHealth:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="sss" placeholder="SSS">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="pagIbig" placeholder="Pag-Ibig">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="philheatlh" placeholder="PhilHealth">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
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

                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <input type="email" class="form-control" id="emailAddress" placeholder="Email Address">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="employeeID" placeholder="Employee ID">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="mobileNumber" placeholder="Mobile Number">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2">
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
                            
                                <div class="row g-3 mb-3">
                                    <div class="col-4">
                                        <select class="form-select" id="department">
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
                                        <select class="form-select" id="designation">
                                            <option selected disabled>Choose Department First</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select type="dropdown" id="shiftID" class="form-select">
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
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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