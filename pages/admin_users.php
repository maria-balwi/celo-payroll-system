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
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <!--AGENTS BUTTON-->
                                <button class="nav-link active uncheck" id="pills-agents-tab" data-bs-toggle="pill" data-bs-target="#pills-agents" type="button" role="tab" aria-controls="pills-agents" aria-selected="true">Agents</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--TL/QA BUTTON-->
                                <button class="nav-link uncheck" id="pills-tlqa-tab" data-bs-toggle="pill" data-bs-target="#pills-tlqa" type="button" role="tab" aria-controls="pills-tlqa" aria-selected="false">TL/QA</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--FACILITIES BUTTON-->
                                <button class="nav-link uncheck" id="pills-facilities-tab" data-bs-toggle="pill" data-bs-target="#pills-facilities" type="button" role="tab" aria-controls="pills-facilities" aria-selected="false">Business Devs</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--FINANCE BUTTON-->
                                <button class="nav-link uncheck" id="pills-finance-tab" data-bs-toggle="pill" data-bs-target="#pills-finance" type="button" role="tab" aria-controls="pills-finance" aria-selected="false">Finance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--IT BUTTON-->
                                <button class="nav-link uncheck" id="pills-it-tab" data-bs-toggle="pill" data-bs-target="#pills-it" type="button" role="tab" aria-controls="pills-it" aria-selected="false">IT</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--HR BUTTON-->
                                <button class="nav-link uncheck" id="pills-hr-tab" data-bs-toggle="pill" data-bs-target="#pills-hr" type="button" role="tab" aria-controls="pills-hr" aria-selected="false">HR</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--DIRECTORS BUTTON-->
                                <button class="nav-link uncheck" id="pills-directors-tab" data-bs-toggle="pill" data-bs-target="#pills-directors" type="button" role="tab" aria-controls="pills-directors" aria-selected="false">Directors</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- -------------------------------------------- PERSONNEL TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-agents" role="tabpanel" aria-labelledby="pills-agents-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="agents-active-tab" data-bs-toggle="pill" data-bs-target="#agents-active" type="button" role="tab" aria-controls="agents-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="agents-inactive-tab" data-bs-toggle="pill" data-bs-target="#agents-inactive" type="button" role="tab" aria-controls="agents-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE PERSONNEL TABLE  -->
                                        <div class="tab-pane fade show active" id="agents-active" role="tabpanel" aria-labelledby="agents-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="personnelTable" style="width: 100%;">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $personnel = mysqli_query($conn, $employees->viewPersonnel());
                                                        while ($personnelDetails = mysqli_fetch_array($personnel)) {
                                                            
                                                            $userID = $personnelDetails['userID'];
                                                            $employeeID = $personnelDetails['employeeID'];
                                                            $personnelName = $personnelDetails['firstName'] . " " . $personnelDetails['lastName'];
                                                            $personnelEmailAdd = $personnelDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$personnelName."</td>";
                                                            echo "<td>".$personnelEmailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE PERSONNEL TABLE  -->
                                        <div class="tab-pane fade" id="agents-inactive" role="tabpanel" aria-labelledby="agents-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactivePersonnelTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactivePersonnel = mysqli_query($conn, $employees->viewInactivePersonnel());
                                                        while ($inactivePersonnelDetails = mysqli_fetch_array($inactivePersonnel)) {
                                                            
                                                            $userID = $inactivePersonnelDetails['userID'];
                                                            $employeeID = $inactivePersonnelDetails['employeeID'];
                                                            $inactivePersonnelName = $inactivePersonnelDetails['firstName'] . " " . $inactivePersonnelDetails['lastName'];
                                                            $inactivePersonnelEmailAdd = $inactivePersonnelDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactivePersonnelName."</td>";
                                                            echo "<td>".$inactivePersonnelEmailAdd."</td>";
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
                            <!-- -------------------------------------------- TL/QA TAB ------------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-tlqa" role="tabpanel" aria-labelledby="pills-tlqa-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="tlqa-active-tab" data-bs-toggle="pill" data-bs-target="#tlqa-active" type="button" role="tab" aria-controls="tlqa-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tlqa-inactive-tab" data-bs-toggle="pill" data-bs-target="#tlqa-inactive" type="button" role="tab" aria-controls="tlqa-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE PERSONNEL TABLE  -->
                                        <div class="tab-pane fade show active" id="tlqa-active" role="tabpanel" aria-labelledby="tlqa-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="tlqaTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $tlqa = mysqli_query($conn, $employees->viewTLQA());
                                                        while ($tlqaDetails = mysqli_fetch_array($tlqa)) {
                                                            
                                                            $userID = $tlqaDetails['userID'];
                                                            $employeeID = $tlqaDetails['employeeID'];
                                                            $personnelName = $tlqaDetails['firstName'] . " " . $tlqaDetails['lastName'];
                                                            $emailAdd = $tlqaDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='userView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$personnelName."</td>";
                                                            echo "<td>".$emailAdd."</td>";
                                                            echo "</td>";

                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- INACTIVE PERSONNEL TABLE  -->
                                        <div class="tab-pane fade" id="tlqa-inactive" role="tabpanel" aria-labelledby="tlqa-inactive-tab">
                                            <table class="table table-striped table-bordered pt-2" id="inactiveTlqaTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $inactiveTLQA = mysqli_query($conn, $employees->viewInactiveTLQA());
                                                        while ($inactiveTLQAdetails = mysqli_fetch_array($inactiveTLQA)) {
                                                            
                                                            $userID = $inactiveTLQAdetails['userID'];
                                                            $employeeID = $inactiveTLQAdetails['employeeID'];
                                                            $inactivePersonnelName = $inactiveTLQAdetails['firstName'] . " " . $inactiveTLQAdetails['lastName'];
                                                            $inactiveEmailAdd = $inactiveTLQAdetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactivePersonnelName."</td>";
                                                            echo "<td>".$inactiveEmailAdd."</td>";
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
                            <!-- ------------------------------------------ FACILITIES TAB --------------------------------------- -->
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
                                        <!-- ACTIVE FACILITIES TABLE  -->
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

                                        <!-- INACTIVE FACILITIES TABLE  -->
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
                                                        $inactiveFinance = mysqli_query($conn, $employees->viewInactiveFinance());
                                                        while ($inactiveFinanceDetails = mysqli_fetch_array($inactiveFinance)) {
                                                            
                                                            $userID = $inactiveFinanceDetails['userID'];
                                                            $employeeID = $inactiveFinanceDetails['employeeID'];
                                                            $inactiveFinance = $inactiveFinanceDetails['firstName'] . " " . $inactiveFinanceDetails['lastName'];
                                                            $inactiveFinanceEmailAdd = $inactiveFinanceDetails['emailAddress'];
                                                

                                                            echo "<tr data-id='".$userID."' class='inactiveUserView cursor-pointer'>";
                                                            echo "<td>".$employeeID."</td>";
                                                            echo "<td>".$inactiveFinance."</td>";
                                                            echo "<td>".$inactiveFinanceEmailAdd."</td>";
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
                            <div class="tab-pane fade" id="pills-directors" role="tabpanel" aria-labelledby="pills-directors-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills mt-0 mb-3" id="pills-tab-inactive" role="tablist">
                                        <!-- ACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="directors-active-tab" data-bs-toggle="pill" data-bs-target="#directors-active" type="button" role="tab" aria-controls="directors-active" aria-selected="true">Active</button>
                                        </li>
                                        <!-- INACTIVE BUTTON -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="directors-inactive-tab" data-bs-toggle="pill" data-bs-target="#directors-inactive" type="button" role="tab" aria-controls="directors-inactive" aria-selected="false">Inactive</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- ACTIVE DIRECTORS TABLE  -->
                                        <div class="tab-pane fade show active" id="directors-active" role="tabpanel" aria-labelledby="directors-active-tab">
                                            <table class="table table-striped table-bordered pt-2" id="directorsTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
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

                                        <!-- INACTIVE DIRECTORS TABLE  -->
                                        <div class="tab-pane fade" id="directors-inactive" role="tabpanel" aria-labelledby="directors-inactive-tab">
                                            <table class="table table-striped table-bordered  pt-2" id="inactiveDirectorsTable">
                                                <thead class="table-light">
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                </thead>
                                                <tbody>
                                                    <?php
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
                        </div>
                    </div>

                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    
        <script src="../assets/js/admin_users.js"></script>
        

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>