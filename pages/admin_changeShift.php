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
            <div class="flex flex-1 p-2 text-2xl font-bold items-center">
                <div class="mr-4">
                    Change Shift Requests
                </div>  

                <!-- DATA RANGE DROPDOWN MENU -->
                <div class="relative inline-block text-right">
                    <button id="dropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-blue-500 hover:bg-gray-50 focus:outline-none">
                    Jun 15, 2024 - Jun 21, 2024
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                    </svg>
                    </button>
                    <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Today</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Yesterday</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last 7 days</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last 30 days</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">This Month</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Last Month</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Custom Range</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATATABLE -->
                <div class="container mx-auto mt-5 overflow-auto">
                    <table id="changeShiftTable" class="min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Current Shift</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Shift</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Jun 16, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">Maria Patrice Reyes</td>
                                <td class="px-6 py-4 whitespace-nowrap">12:00 PM - 9:00 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap">9:00 AM - 6:00 PM</td>
                                <td class="px-6 py-4 whitespace-nowrap">Jun 17, 2024 - Jun 21, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-500">Approved</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </td>
                            </tr> -->
                            <?php
                                function formatDate($date) {
                                    // Create a DateTime object from the string
                                    $dateTime = new DateTime($date);
                                
                                    // Format the date
                                    return $dateTime->format('M d, Y');
                                }

                                $shiftQuery = mysqli_query($conn, $employees->viewAdminChangeShiftRequest());
                                while ($shiftDetails = mysqli_fetch_array($shiftQuery)) {

                                    $shift_id = $shiftDetails['id'];
                                    $shift_dateFiled = $shiftDetails['dateFiled'];
                                    $shift_employeeName = $shiftDetails['employeeName'];
                                    $shift_currentShift = $shiftDetails['currentShift'];
                                    $shift_requestedShift = $shiftDetails['requestedShift'];
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
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_employeeName . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_currentShift . "</td>";
                                    echo "<td ='px-6 py-4 whitespace-nowrap'>" . $shift_requestedShift . "</td>";
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
    
        <script src="../assets/js/team_changeShift.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>