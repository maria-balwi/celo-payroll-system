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
                    Holidays
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="relative inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline">Add Holiday</button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700 flex gap-4 p-4">
                <!-- CALENDAR -->
                <!-- <div id="calendar" class="w-full mx-auto bg-white shadow-md rounded-lg p-4 mb-4"> -->
                <div id="calendar" class="w-1/2 bg-white shadow-md rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <button id="prev" class="text-lg font-bold">
                            <svg class="h-8 w-8 text-neutral-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M18 15l-6-6l-6 6h12" transform="rotate(270 12 12)" />
                            </svg>
                        </button>
                        <div id="monthYear" class="text-lg font-bold"></div>
                        <button id="next" class="text-lg font-bold">
                            <svg class="h-8 w-8 text-neutral-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M18 15l-6-6l-6 6h12" transform="rotate(90 12 12)" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 gap-5 text-center">
                        <div class="font-bold">Sun</div>
                        <div class="font-bold">Mon</div>
                        <div class="font-bold">Tue</div>
                        <div class="font-bold">Wed</div>
                        <div class="font-bold">Thu</div>
                        <div class="font-bold">Fri</div>
                        <div class="font-bold">Sat</div>
                    </div>
                    <div id="days" class="grid grid-cols-7 gap-5 text-center mt-2">
                        <!-- Days will be injected here by jQuery -->
                    </div>
                </div>

                <!-- DATATABLE -->
                <div class="w-1/2 bg-white shadow-md rounded-lg p-4 mx-auto overflow-auto">
                    <table id="holidayTable" class="table table-auto min-w-full divide-y divide-gray-200 table-striped table-bordered text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">No.</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Name</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Type</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Date From</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Date To</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider align-middle whitespace-nowrap">Category</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                function modifyDate($date) {
                                    // Get the current year
                                    $currentYear = date('Y');
                                    
                                    // Append the current year to the input date
                                    $dateWithYear = $date . '-' . $currentYear;
                                    
                                    // Create a DateTime object from the string (expects format MM-DD-YYYY)
                                    $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);
                                    
                                    // Format the date as 'M d, Y'
                                    return $dateTime->format('M d, Y');
                                }

                                $holidayQuery = mysqli_query($conn, $payroll->viewHolidays());
                                while ($holidayDetails = mysqli_fetch_array($holidayQuery)) {
                                    $holidayID = $holidayDetails['holidayID'];
                                    $holidayName = $holidayDetails['holidayName'];
                                    $holidayType = $holidayDetails['type'];
                                    $holidayDateFrom = $holidayDetails['dateFrom'];
                                    $holidayDateTo = $holidayDetails['dateTo'];
                                    $holidayCategory = $holidayDetails['category'] == 1 ? "Fixed - Yearly" : "Not Fixed";
                                    ;

                                    echo "<tr>";
                                    echo "<td class ='whitespace-nowrap'>" . $holidayID . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $holidayName . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $holidayType . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . modifyDate($holidayDateFrom) . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . modifyDate($holidayDateTo) . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $holidayCategory . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- <div class="flex sm:grid-cols-1 gap-4 p-3 overflow-auto">
                    <div>Legend:</div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Rest Day
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Default Shift
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Requested Shift
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Plotted Shift
                    </div>
                </div> -->
            </div>
        </main>
    
        <script src="../assets/js/admin_holidays.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>