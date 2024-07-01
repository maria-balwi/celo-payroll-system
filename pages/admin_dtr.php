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
                    Daily Time Records
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl px-3 py-4 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="example" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Emp ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Worked</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Absents</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lates</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Undertime</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overtime</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">00114</td>
                                <td class="px-6 py-4 whitespace-nowrap">SAMPANG, JOHN PAUL PELIAZAR</td>
                                <td class="px-6 py-4 whitespace-nowrap">Celo Business Solutions Inc.</td>
                                <td class="px-6 py-4 whitespace-nowrap">9pm - 6am</td>
                                <td class="px-6 py-4 whitespace-nowrap">5</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">2</td>
                                <td class="px-6 py-4 whitespace-nowrap">196</td>
                                <td class="px-6 py-4 whitespace-nowrap">547</td>
                                <td class="px-6 py-4 whitespace-nowrap">512</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">00115</td>
                                <td class="px-6 py-4 whitespace-nowrap">PALENCIA, CHRISTIAN  JAY MANAHAN</td>
                                <td class="px-6 py-4 whitespace-nowrap">Celo Business Solutions Inc.</td>
                                <td class="px-6 py-4 whitespace-nowrap">9pm - 6am</td>
                                <td class="px-6 py-4 whitespace-nowrap">6</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">49</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">00116</td>
                                <td class="px-6 py-4 whitespace-nowrap">ODULIO, JOSEPH PAUL GAVINO</td>
                                <td class="px-6 py-4 whitespace-nowrap">Celo Business Solutions Inc.</td>
                                <td class="px-6 py-4 whitespace-nowrap">6am - 3pm</td>
                                <td class="px-6 py-4 whitespace-nowrap">4</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                <td class="px-6 py-4 whitespace-nowrap">1482</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">00117</td>
                                <td class="px-6 py-4 whitespace-nowrap">REYES, MARIA PATRICE ALVAREZ</td>
                                <td class="px-6 py-4 whitespace-nowrap">Celo Business Solutions Inc.</td>
                                <td class="px-6 py-4 whitespace-nowrap">9am - 6pm</td>
                                <td class="px-6 py-4 whitespace-nowrap">5</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">170</td>
                                <td class="px-6 py-4 whitespace-nowrap">204</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <svg class="h-6 w-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/team_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>