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
                <div>Disputes</div>    
                <input type="hidden" id="adminID" name="adminID" value="<?php echo $_SESSION['designationID']; ?>">  
            </div>
            
            <!-- CONTENT -->
            <div class="bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="card shadow-sm bInfo">
                    <div class="card-header">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <!--ATTENDANCE DISPUTES BUTTON-->
                                <button class="nav-link active uncheck" id="pills-attendance-tab" data-bs-toggle="pill" data-bs-target="#pills-attendance" type="button" role="tab" aria-controls="pills-attendances" aria-selected="true">Attendance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--LEAVES DISPUTES BUTTON-->
                                <button class="nav-link uncheck" id="pills-leaves-tab" data-bs-toggle="pill" data-bs-target="#pills-leaves" type="button" role="tab" aria-controls="pills-leaves" aria-selected="false">Leaves</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <!--OVERTIME DISPUTES BUTTON-->
                                <button class="nav-link uncheck" id="pills-overtime-tab" data-bs-toggle="pill" data-bs-target="#pills-overtime" type="button" role="tab" aria-controls="pills-overtime" aria-selected="false">Overtime</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- ATTENDANCE TAB -------------------------------------- -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade show active" id="pills-attendance" role="tabpanel" aria-labelledby="pills-attendance-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <!--PENDING BUTTON-->
                                            <button class="nav-link active" id="attendance-pending-tab" data-bs-toggle="pill" data-bs-target="#attendance-pending" type="button" role="tab" aria-controls="attendance-pending" aria-selected="true">Pending</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--APPROVED BUTTON-->
                                            <button class="nav-link" id="attendance-approved-tab" data-bs-toggle="pill" data-bs-target="#attendance-approved" type="button" role="tab" aria-controls="attendance-approved" aria-selected="false">Approved</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--DISAPPROVED BUTTON-->
                                            <button class="nav-link" id="attendance-disapproved-tab" data-bs-toggle="pill" data-bs-target="#attendance-disapproved" type="button" role="tab" aria-controls="attendance-disapproved" aria-selected="false">Disapproved</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-2" id="pills-tabContent">
                                        <!-- ATTENDANCE - PENDING TABLE  -->
                                        <div class="tab-pane fade show active" id="attendance-pending" role="tabpanel" aria-labelledby="attendance-pending-tab">
                                            <table id="pendingAttendanceTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        function formatDateTime($attendanceDate, $attendanceTime) {
                                                            $attendanceDateTime = $attendanceDate . " " . $attendanceTime;
                                                            return date('M d, Y h:i A', strtotime($attendanceDateTime));
                                                        }

                                                        function formatDate($date) {
                                                            // Create a DateTime object from the string
                                                            $dateTime = new DateTime($date);
                                                        
                                                            // Format the date
                                                            return $dateTime->format('M d, Y');
                                                        }


                                                        $disputeAttendance = mysqli_query($conn, $payroll->pendingDisputesAttendance());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeAttendance)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $employeeID = $disputeDetails['employeeID'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $timeInDate = $disputeDetails['attendanceDate_timeIn'];
                                                            $timeInTime = $disputeDetails['attendanceTime_timeIn'];
                                                            $timeOutDate = $disputeDetails['attendanceDate_timeOut'];
                                                            $timeOutTime = $disputeDetails['attendanceTime_timeOut'];
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';

                                                            // FORMAT DATE AND TIME
                                                            $attendanceDateTime_in = formatDateTime($timeInDate, $timeInTime);
                                                            $attendanceDateTime_out = formatDateTime($timeOutDate, $timeOutTime);

                                                            echo "<tr data-id='" . $disputeID . "' class='attendanceView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . $employeeID . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_in . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_out . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- ATTENDANCE - APPROVED TABLE  -->
                                        <div class="tab-pane fade" id="attendance-approved" role="tabpanel" aria-labelledby="attendance-approved-tab">
                                            <table id="approvedAttendanceTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeAttendance = mysqli_query($conn, $payroll->approvedDisputesAttendance());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeAttendance)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $employeeID = $disputeDetails['employeeID'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $timeInDate = $disputeDetails['attendanceDate_timeIn'];
                                                            $timeInTime = $disputeDetails['attendanceTime_timeIn'];
                                                            $timeOutDate = $disputeDetails['attendanceDate_timeOut'];
                                                            $timeOutTime = $disputeDetails['attendanceTime_timeOut'];
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';

                                                            // FORMAT DATE AND TIME
                                                            $attendanceDateTime_in = formatDateTime($timeInDate, $timeInTime);
                                                            $attendanceDateTime_out = formatDateTime($timeOutDate, $timeOutTime);

                                                            echo "<tr data-id='" . $disputeID . "' class='attendanceView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . $employeeID . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_in . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_out . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- ATTENDANCE - DISAPPROVED TABLE  -->
                                        <div class="tab-pane fade" id="attendance-disapproved" role="tabpanel" aria-labelledby="attendance-disapproved-tab">
                                            <table id="disapprovedAttendanceTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeAttendance = mysqli_query($conn, $payroll->disapprovedDisputesAttendance());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeAttendance)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $employeeID = $disputeDetails['employeeID'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $timeInDate = $disputeDetails['attendanceDate_timeIn'];
                                                            $timeInTime = $disputeDetails['attendanceTime_timeIn'];
                                                            $timeOutDate = $disputeDetails['attendanceDate_timeOut'];
                                                            $timeOutTime = $disputeDetails['attendanceTime_timeOut'];
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';

                                                            // FORMAT DATE AND TIME
                                                            $attendanceDateTime_in = formatDateTime($timeInDate, $timeInTime);
                                                            $attendanceDateTime_out = formatDateTime($timeOutDate, $timeOutTime);

                                                            echo "<tr data-id='" . $disputeID . "' class='attendanceView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . $employeeID . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_in . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $attendanceDateTime_out . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ------------------------------------------- LEAVES TAB ------------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-leaves" role="tabpanel" aria-labelledby="pills-leaves-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <!--PENDING BUTTON-->
                                            <button class="nav-link active" id="leaves-pending-tab" data-bs-toggle="pill" data-bs-target="#leaves-pending" type="button" role="tab" aria-controls="leaves-pending" aria-selected="true">Pending</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--APPROVED BUTTON-->
                                            <button class="nav-link" id="leaves-approved-tab" data-bs-toggle="pill" data-bs-target="#leaves-approved" type="button" role="tab" aria-controls="leaves-approved" aria-selected="false">Approved</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--DISAPPROVED BUTTON-->
                                            <button class="nav-link" id="leaves-disapproved-tab" data-bs-toggle="pill" data-bs-target="#leaves-disapproved" type="button" role="tab" aria-controls="leaves-disapproved" aria-selected="false">Disapproved</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-2" id="pills-tabContent">
                                        <!-- LEAVES - PENDING TABLE  -->
                                        <div class="tab-pane fade show active" id="leaves-pending" role="tabpanel" aria-labelledby="leaves-pending-tab">
                                            <table id="pendingLeavesTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeLeaves = mysqli_query($conn, $payroll->pendingDisputesLeaves());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeLeaves)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $leaveType = $disputeDetails['leaveType'] ?? '';
                                                            // $inclusiveDates = formatDate($disputeDetails['startDate']) . " - " . formatDate($disputeDetails['endDate']);
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';
                                                            $leave_days = 0;
                                                            $startDate = new DateTime($disputeDetails['startDate']);
                                                            $endDate = new DateTime($disputeDetails['endDate']);
                                                            $endDate = $endDate->modify('+1 day');

                                                            while ($startDate < $endDate) {
                                                                $leave_days++;
                                                                $startDate->modify('+1 day');
                                                            }

                                                            if ($leave_days <= 1) {
                                                                $leave_days = $leave_days . " day";
                                                            }
                                                            else {
                                                                $leave_days = $leave_days . " days";
                                                            }

                                                            echo "<tr data-id='" . $disputeID . "' class='leaveView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leaveType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // if ($status == "Pending") {
                                                            //     echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Approved") {
                                                            //     echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Disapproved") {
                                                            //     echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEAVES - APPROVED TABLE  -->
                                        <div class="tab-pane fade" id="leaves-approved" role="tabpanel" aria-labelledby="leaves-approved-tab">
                                            <table id="approvedLeavesTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeLeaves = mysqli_query($conn, $payroll->approvedDisputesLeaves());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeLeaves)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $leaveType = $disputeDetails['leaveType'] ?? '';
                                                            // $inclusiveDates = formatDate($disputeDetails['startDate']) . " - " . formatDate($disputeDetails['endDate']);
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';
                                                            $leave_days = 0;
                                                            $startDate = new DateTime($disputeDetails['startDate']);
                                                            $endDate = new DateTime($disputeDetails['endDate']);
                                                            $endDate = $endDate->modify('+1 day');

                                                            while ($startDate < $endDate) {
                                                                $leave_days++;
                                                                $startDate->modify('+1 day');
                                                            }

                                                            if ($leave_days <= 1) {
                                                                $leave_days = $leave_days . " day";
                                                            }
                                                            else {
                                                                $leave_days = $leave_days . " days";
                                                            }

                                                            echo "<tr data-id='" . $disputeID . "' class='leaveView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leaveType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // if ($status == "Pending") {
                                                            //     echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Approved") {
                                                            //     echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Disapproved") {
                                                            //     echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- LEAVES - DISAPPROVED TABLE  -->
                                        <div class="tab-pane fade" id="leaves-disapproved" role="tabpanel" aria-labelledby="leaves-disapproved-tab">
                                            <table id="disapprovedLeavesTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeLeaves = mysqli_query($conn, $payroll->disapprovedDisputesLeaves());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeLeaves)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $leaveType = $disputeDetails['leaveType'] ?? '';
                                                            // $inclusiveDates = formatDate($disputeDetails['startDate']) . " - " . formatDate($disputeDetails['endDate']);
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';
                                                            $leave_days = 0;
                                                            $startDate = new DateTime($disputeDetails['startDate']);
                                                            $endDate = new DateTime($disputeDetails['endDate']);
                                                            $endDate = $endDate->modify('+1 day');

                                                            while ($startDate < $endDate) {
                                                                $leave_days++;
                                                                $startDate->modify('+1 day');
                                                            }

                                                            if ($leave_days <= 1) {
                                                                $leave_days = $leave_days . " day";
                                                            }
                                                            else {
                                                                $leave_days = $leave_days . " days";
                                                            }

                                                            echo "<tr data-id='" . $disputeID . "' class='leaveView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leaveType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $leave_days . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // if ($status == "Pending") {
                                                            //     echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Approved") {
                                                            //     echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            // else if ($status == "Disapproved") {
                                                            //     echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 my-auto rounded-full text-sm'>". $status . "</p></td>";
                                                            // }
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <!-- ----------------------------------------- OVERTIME TAB ------------------------------------ -->
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="tab-pane fade" id="pills-overtime" role="tabpanel" aria-labelledby="pills-overtime-tab">
                                <div class="card border-0">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <!--PENDING BUTTON-->
                                            <button class="nav-link active" id="overtime-pending-tab" data-bs-toggle="pill" data-bs-target="#overtime-pending" type="button" role="tab" aria-controls="overtime-pending" aria-selected="true">Pending</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--APPROVED BUTTON-->
                                            <button class="nav-link" id="overtime-approved-tab" data-bs-toggle="pill" data-bs-target="#overtime-approved" type="button" role="tab" aria-controls="overtime-approved" aria-selected="false">Approved</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <!--DISAPPROVED BUTTON-->
                                            <button class="nav-link" id="overtime-disapproved-tab" data-bs-toggle="pill" data-bs-target="#overtime-disapproved" type="button" role="tab" aria-controls="overtime-disapproved" aria-selected="false">Disapproved</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-2" id="pills-tabContent">
                                        <!-- OVERTIME - PENDING TABLE  -->
                                        <div class="tab-pane fade show active" id="overtime-pending" role="tabpanel" aria-labelledby="overtime-pending-tab">
                                            <table id="pendingOvertimeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeOvertime = mysqli_query($conn, $payroll->pendingDisputesOvertime());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeOvertime)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $otDate = $disputeDetails['otDate'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $otType = $disputeDetails['otType'] ?? '';
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';


                                                            echo "<tr data-id='" . $disputeID . "' class='overtimeView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($otDate) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $otType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- OVERTIME - APPROVED TABLE  -->
                                        <div class="tab-pane fade" id="overtime-approved" role="tabpanel" aria-labelledby="overtime-approved-tab">
                                            <table id="approvedOvertimeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeOvertime = mysqli_query($conn, $payroll->approvedDisputesOvertime());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeOvertime)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $otDate = $disputeDetails['otDate'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $otType = $disputeDetails['otType'] ?? '';
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';


                                                            echo "<tr data-id='" . $disputeID . "' class='overtimeView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($otDate) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $otType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- OVERTIME - DISAPPROVED TABLE  -->
                                        <div class="tab-pane fade" id="overtime-disapproved" role="tabpanel" aria-labelledby="overtime-disapproved-tab">
                                            <table id="disapprovedOvertimeTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3 mt-2">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                                        <!-- <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php
                                                        $disputeOvertime = mysqli_query($conn, $payroll->disapprovedDisputesOvertime());
                                                        while ($disputeDetails = mysqli_fetch_array($disputeOvertime)) {

                                                            $disputeID = $disputeDetails['disputeID'];
                                                            $dateFiled = $disputeDetails['dateFiled'];
                                                            $otDate = $disputeDetails['otDate'];
                                                            $employeeName = $disputeDetails['firstName'] . " " . $disputeDetails['lastName'];
                                                            $otType = $disputeDetails['otType'] ?? '';
                                                            $remarks = $disputeDetails['remarks'] ?? '';
                                                            $status = $disputeDetails['status'] ?? '';


                                                            echo "<tr data-id='" . $disputeID . "' class='overtimeView cursor-pointer'>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($dateFiled) . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . formatDate($otDate) . "</td>";
                                                            echo "<td class =' text-left whitespace-nowrap'>" . $employeeName . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $otType . "</td>";
                                                            echo "<td class ='whitespace-nowrap'>" . $remarks . "</td>";
                                                            // echo "<td class ='whitespace-nowrap'>" . $status . "</td>";
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

                    <!-- CARD FOOTER DATA ENTRY BUTTON -->
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#fileDisputeModal">File Dispute</button>
                    </div>
                </div>
            </div>
            

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------- ADD DATA MODAL ------------------------------------------------------------>
            <form id="fileDisputeForm">
                <div class="modal fade" id="fileDisputeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-dialog-centered">
                        <div class="modal-content" id="fileDisputeModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">File Dispute</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-6">
                                        <label for="dataType">Type:</label>
                                    </div>
                                    <div class="col-6 dateFiledSection">
                                        <label for="dateFiled">Date Filed:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <select class="form-select" id="dataType" name="dataType">
                                            <option disabled selected>Choose</option>
                                            <option value="1">Attendance</option>
                                            <option value="2">Leave</option>
                                            <option value="3">Overtime</option>
                                        </select>
                                    </div>
                                    <div class="col-6 dateFiledSection">
                                        <input type="text" class="form-control" id="dateFiled" value="<?php echo date("M d, Y") ?>" disabled readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 employeeSection">
                                    <div class="col-6">
                                        <label for="employeeID">Employee ID:</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="employeeName">Employee Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 employeeSection">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="employeeID" name="employeeID">
                                        <input type="hidden" class="form-control" id="empID" name="empID">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="employeeName" name="employeeName" disabled readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 attendanceSection">
                                    <div class="col-6">
                                        <label for="attendanceDate_timeIn">Time In - Date:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="attendanceTime_timeIn">Time:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="attendanceLogType_timeIn">Log Type:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 attendanceSection">
                                    <div class="col-5">
                                        <input type="date" class="form-control" id="attendanceDate_timeIn" name="attendanceDate_timeIn">
                                    </div>
                                     <div class="col-4">
                                        <input type="time" class="form-control" id="attendanceTime_timeIn" name="attendanceTime_timeIn">
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select" id="attendanceLogType_timeIn" name="attendanceLogType_timeIn">
                                            <option disabled selected>Choose</option>
                                            <option value="1">Time In</option>
                                            <option value="2">Late</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 attendanceSection">
                                    <div class="col-5">
                                        <label for="attendanceDate_timeOut">Time Out - Date:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="attendanceTime_timeOut">Time:</label>
                                    </div>
                                    <div class="col-3">
                                        <label for="attendanceLogType_timeOut">Log Type:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 overtimeSection">
                                    <div class="col-6">
                                        <label for="overtimeOTDate">OT Date:</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="otType">Type:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 overtimeSection">
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="overtimeOTDate" name="overtimeOTDate">
                                    </div>
                                    <div class="col-6">
                                        <select name="otType" id="otType" class="form-select">
                                            <option disabled selected>Choose</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Rest Day">Rest Day</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 attendanceSection">
                                    <div class="col-5">
                                        <input type="date" class="form-control" id="attendanceDate_timeOut" name="attendanceDate_timeOut">
                                    </div>
                                    <div class="col-4">
                                        <input type="time" class="form-control" id="attendanceTime_timeOut" name="attendanceTime_timeOut">
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select" id="attendanceLogType_timeOut" name="attendanceLogType_timeOut">
                                            <option disabled selected>Choose</option>
                                            <option value="3">Undertime</option>
                                            <option value="4">Time Out</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 leaveSection">
                                    <div class="col-6">
                                        <label for="leaveType">Leave Type:</label>
                                    </div>
                                </div>

                                <div class="row g-3 mb-2 leaveSection">
                                    <div class="col-12">
                                        <select class="form-select border border-1" id="leaveType" name="leaveType" required>
                                            <option selected disabled>Choose Leave Type</option>
                                            <option value="1" disabled>Sick Leave</option>
                                            <option value="2">Vacation Leave</option>
                                            <option value="3">Bereavement Leave</option>
                                            <option value="4">Maternity Leave</option>
                                            <option value="5">Maternity Leave (Solo Parent)</option>
                                            <option value="6">Maternity Leave (Miscarriage)</option>
                                            <option value="7">Paternity Leave</option>
                                            <option value="8">Solo Parent Leave</option>
                                            <option value="9">Emergency Leave</option>
                                        </select>
                                    </div>
                                </div>  

                                <div class="row g-2 mb-1 leaveSection">
                                    <div class="col-6">
                                        <label for="leaveStartDate">Start Date</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="leaveEndDate">End Date:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 leaveSection">
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="leaveStartDate" name="leaveStartDate">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="leaveEndDate" name="leaveEndDate">
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 overtimeSection">
                                    <div class="col-6">
                                        <label for="overtimeFromTime">From:</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="overtimeToTime">To:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 overtimeSection">
                                    <div class="col-6">
                                        <input type="time" class="form-control" id="overtimeFromTime" name="overtimeFromTime">
                                    </div>
                                     <div class="col-6">
                                        <input type="time" class="form-control" id="overtimeToTime" name="overtimeToTime">
                                    </div>
                                </div>

                                <div class="row g-3 mb-2 leaveSection">
                                    <div class="col-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input attachment" type="checkbox" id="withAttachment" name="withAttachment">
                                            <label class="form-check-label" for="withAttachment">With Attachment</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input attachment" type="checkbox" id="withoutAttachment" name="withoutAttachment">
                                            <label class="form-check-label" for="withoutAttachment">Without Attachment</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1 remarksSection">
                                    <div class="col-12">
                                        <label for="remarks">Remarks:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2 remarksSection">
                                    <div class="col-12">
                                        <textarea type="text" class="form-control" id="remarks" rows="3"></textarea>
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
            <!------------------------------------------------------------ VIEW DATA MODAL ----------------------------------------------------------->
            <div class="modal fade" id="viewModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-dialog-centered">
                    <div class="modal-content" id="viewModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Data</h1>
                            <input type="hidden" id="viewDisputeID">
                            <input type="hidden" id="userDept" value="<?php echo $_SESSION['departmentID']; ?>">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-3">
                                    <label for="viewDataType">Type:</label>
                                </div>
                                <div class="col-5 dateFiledSection">
                                    <label for="viewDateFiled">Date Filed:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewStatus">Status:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewDataType" disabled readonly>
                                </div>
                                <div class="col-5 dateFiledSection">
                                    <input type="text" class="form-control" id="viewDateFiled" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewStatus" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 employeeSection">
                                <div class="col-6">
                                    <label for="viewEmployeeID">Employee ID:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewEmployeeName">Employee Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 employeeSection">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewEmployeeID" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewEmployeeName" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 attendanceSection">
                                <div class="col-5">
                                    <label for="viewAttendanceDate_timeIn">Time In - Date:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewAttendanceTime_timeIn">Time:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewAttendanceLogType_timeIn">Log Type:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 attendanceSection">
                                <div class="col-5">
                                    <input type="text" class="form-control" id="viewAttendanceDate_timeIn" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="time" class="form-control" id="viewAttendanceTime_timeIn" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewAttendanceLogType_timeIn" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 attendanceSection">
                                <div class="col-5">
                                    <label for="viewAttendanceDate_timeOut">Time Out - Date:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewAttendanceTime_timeOut">Time:</label>
                                </div>
                                <div class="col-3">
                                    <label for="viewAttendanceLogType_timeOut">Log Type:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 overtimeSection">
                                <div class="col-6">
                                    <label for="viewOvertimeOTDate">OT Date:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewOtType">Type:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 overtimeSection">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewOvertimeOTDate" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewOtType" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 attendanceSection">
                                <div class="col-5">
                                    <input type="text" class="form-control" id="viewAttendanceDate_timeOut" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="time" class="form-control" id="viewAttendanceTime_timeOut" disabled readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="viewAttendanceLogType_timeOut" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 leaveSection">
                                <div class="col-6">
                                    <label for="viewLeaveType">Leave Type:</label>
                                </div>
                            </div>

                            <div class="row g-3 mb-2 leaveSection">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="viewLeaveType" disabled readonly>
                                </div>
                            </div>  

                            <div class="row g-2 mb-1 leaveSection">
                                <div class="col-6">
                                    <label for="viewLeaveStartDate">Start Date</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewLeaveEndDate">End Date:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 leaveSection">
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewLeaveStartDate" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="viewLeaveEndDate" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 overtimeSection">
                                <div class="col-6">
                                    <label for="viewOvertimeFromTime">From:</label>
                                </div>
                                <div class="col-6">
                                    <label for="viewOvertimeToTime">To:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 overtimeSection">
                                <div class="col-6">
                                    <input type="time" class="form-control" id="viewOvertimeFromTime" disabled readonly>
                                </div>
                                <div class="col-6">
                                    <input type="time" class="form-control" id="viewOvertimeToTime" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2" id="viewWithAttachmentRow">
                                <div class="col-12">
                                    <label class="text-blue-500">With Attachment</label>
                                </div>
                            </div>
                            <div class="row g-2" id="viewWithoutAttachmentRow">
                                <div class="col-12">
                                    <label class="text-blue-500">Without Attachment</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-1 remarksSection">
                                <div class="col-12">
                                    <label for="viewRemarks">Remarks:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2 remarksSection">
                                <div class="col-12">
                                    <textarea type="text" class="form-control" id="viewRemarks" rows="3" disabled readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success approveDispute" id="approveDispute">Approve</button>
                            <button type="button" class="btn btn-danger disapproveDispute" id="disapproveDispute">Disapprove</button>
                            <!-- <button type="button" class="btn btn-primary allowanceUpdate" id="btnAllowanceUpdate">Update</button>
                            <button type="button" class="btn btn-danger allowanceDelete" id="btnAllowanceDelete">Delete</button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------------ UPDATE ALLOWANCE MODAL --------------------------------------------------------->
            <form id="updateAllowanceForm">
                <div class="modal fade" id="updateAllowanceModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="updateAllowanceModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Allowance</h1>
                                <input type="hidden" id="updateAllowanceID" name="updateAllowanceID">
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="updateAllowanceName">Allowance Name:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="updateAllowanceName" name="updateAllowanceName">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewAllowanceModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/admin_disputes.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>