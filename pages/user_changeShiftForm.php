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
                    Change Shift Requests
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="user_changeShift.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline">Back</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="flex overflow-auto justify-center">
                <div class="container mx-auto">
                    <div class="grid grid-cols-4 sm:grid-cols-12 gap-3">

                        <!-- LEFT CARD -->
                        <div class="col-span-6 sm:col-span-5">
                            <div class="bg-white shadow rounded-lg p-4">
                                <form id="fileRequestForm">
                                    <div class="flex flex-col items-center">
                                        <h1 class="text-lg font-bold uppercase">Request Shift Change</h1>
                                    </div>
                                    <hr class="my-2 border-t border-gray-300">
                                    <div class="flex flex-col py-1">
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Shifts</h3>
                                            <select type="dropdown" id="newShift" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="" selected disabled>Choose</option>
                                                <?php
                                                    $shift = mysqli_query($conn, $employees->viewShifts());
                                                    while ($shiftResult = mysqli_fetch_array($shift)) {
                                                    ?>
                                                    <option value="<?php echo $shiftResult['shiftID']; ?>">
                                                        <?php echo $shiftResult['startTime'] . ' - ' . $shiftResult['endTime']; ?>
                                                    </option>
                                                    
                                                <?php        
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Effective Dates</h3>
                                            <div class="flex">
                                                <input type="date" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="startDate">
                                                <svg class="h-8 w-8 text-neutral-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                </svg>
                                                <input type="date" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="endDate">
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Purpose</h3>
                                            <textarea id="purpose" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5"></textarea>
                                        </div>
                                        <div>
                                            <button type="submit" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" id="btnFileRequest">File Request</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- RIGHT CARD -->
                        <div class="col-span-6 sm:col-span-7">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <h1 class="text-lg font-bold uppercase">Shift Change Requests</h1>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <!-- DATATABLE -->
                                <div class="container mx-auto overflow-auto">
                                <table id="changeShiftTable2" class="min-w-full divide-y divide-gray-200 table-auto">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Details</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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
                                                $shift_shiftID = $shiftDetails['startTime'] . " - " . $shiftDetails['endTime'];
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
                                                echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_shiftID . "</td>";
                                                echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_effectivityDate . "</td>";
                                                echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_remarks . "</td>";
                                                if ($shift_status == "Pending") {
                                                    echo "<td><p class='inline-block bg-yellow-500 text-white px-3 py-1 mt-3 rounded-full text-sm'>". $shift_status . "</p></td>";
                                                }
                                                else if ($shift_status == "Approved") {
                                                    echo "<td><p class='inline-block bg-green-500 text-white px-3 py-1 mt-3 rounded-full text-sm'>". $shift_status . "</p></td>";
                                                }
                                                else if ($shift_status == "Disapproved") {
                                                    echo "<td><p class='inline-block bg-red-500 text-white px-3 py-1 mt-3 rounded-full text-sm'>". $shift_status . "</p></td>";
                                                }
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
            
        </main>
    
        <script src="../assets/js/change_shift.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>