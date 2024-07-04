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
            <main class="flex-1 p-3 overflow-auto">
                <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                    <div>
                        Leaves
                    </div>    

                    <!-- REQUEST PRE-RENDER BUTTON -->
                    <div class="relative inline-block text-right">
                        <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                        File HR Request
                        </button> -->
                        <a href="user_leaveForm.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline">File a Leave</a>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="2xl:max-w-2xl p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto overflow-auto">
                        <table id="example" class="table min-w-full divide-y divide-gray-200 table-striped table-bordered">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Leave Type</th> -->
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Remarks</th>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid</th> -->
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                    function formatDate($date) {
                                        // Create a DateTime object from the string
                                        $dateTime = new DateTime($date);
                                    
                                        // Format the date
                                        return $dateTime->format('M d, Y');
                                    }

                                    $leaveQuery = mysqli_query($conn, $employees->viewLeaves($_SESSION['id']));
                                    while ($leaveDetails = mysqli_fetch_array($leaveQuery)) {

                                        $leave_id = $leaveDetails['id'];
                                        $leave_dateFiled = $leaveDetails['dateFiled'];
                                        $leave_leaveType = $leaveDetails['leaveType'];
                                        $leave_effectivityStartDate = $leaveDetails['effectivityStartDate'];
                                        $leave_effectivityEndDate = $leaveDetails['effectivityEndDate'];
                                        $leave_remarks = $leaveDetails['remarks'];
                                        $leave_status = $leaveDetails['status'];

                                        $leave_dateFiled = formatDate($leave_dateFiled);
                                        $leave_effectivityStartDate = formatDate($leave_effectivityStartDate);
                                        $leave_effectivityEndDate = formatDate($leave_effectivityEndDate);
                                        $leave_effectivityDate = $leave_effectivityStartDate . " - " . $leave_effectivityEndDate;
                                        
                                        $startDate = new DateTime($leave_effectivityStartDate);
                                        $endDate = new DateTime($leave_effectivityEndDate);
                                        $endDate = $endDate->modify('+1 day');
                                        $leave_days = 0;

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

                                        echo "<tr data-id='" . $leave_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $leave_dateFiled . "</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $leave_leaveType . "</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $leave_days . "</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $leave_effectivityDate . "</td>";
                                        echo "<td ='px-6 whitespace-nowrap'>" . $leave_remarks . "</td>";
                                        if ($leave_status == "Approved") {
                                            echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        else if ($leave_status == "Disapproved") {
                                            echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm'>". $leave_status . "</p></td>";
                                        }
                                        echo "<td class='px-6 whitespace-nowrap'>
                                        <svg class='h-6 w-6 text-gray-500'  fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'/>
                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/>
                                        </svg>
                                    </td>";
                                        echo "</td>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </main>
            
        </div>

        <script src="../assets/js/leaves.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>