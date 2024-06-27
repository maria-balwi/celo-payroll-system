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
                    Change Shift
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="user_changeShiftForm.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Request Shift Change</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="example" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Effectivity Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason | Remarks</th>
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

                                $shiftQuery = mysqli_query($conn, $employees->viewChangeShift($_SESSION['id']));
                                while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                    $shift_id = $shiftDetails['id'];
                                    $shift_dateFiled = $shiftDetails['dateFiled'];
                                    $shift_logType = $shiftDetails['time'];
                                    $shift_effectivityStartDate = $shiftDetails['effectivityStartDate'];
                                    $shift_effectivityEndDate = $shiftDetails['effectivityEndDate'];
                                    $shift_remarks = $shiftDetails['remarks'];
                                    $shift_status = $shiftDetails['status'];

                                    $shift_dateFiled = formatDate($shift_dateFiled);
                                    $shift_effectivityStartDate = formatDate($shift_effectivityStartDate);
                                    $shift_effectivityEndDate = formatDate($shift_effectivityEndDate);
                                    $shift_effectivityDate = $shift_effectivityStartDate . " - " . $shift_effectivityEndDate;

                                    echo "<tr data-id='" . $shift_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_dateFiled . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_logType . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_remarks . "</td>";
                                    if ($shift_status == "Approved") {
                                        echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm'>". $shift_status . "</p></td>";
                                    }
                                    else if ($shift_status == "Disapproved") {
                                        echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm'>". $shift_status . "</p></td>";
                                    }
                                    echo "</td>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/change_shift.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>