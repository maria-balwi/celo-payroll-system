<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../../includes/sidebar.php'); ?>
 
            <!-- MAIN CONTENT -->
            <main class="flex-1 p-3 overflow-auto">
                <div class="flex-1 p-2 text-2xl font-bold">
                    Daily Time Record
                </div>

                <!-- CONTENT -->
                <div class="2xl:max-w-2xl p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto mt-5 overflow-auto">
                        <table id="example" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Face DTR</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shuft</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time In</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start of Break</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End of Break</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Out</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Late</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UT</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RMW</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total OT</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total ND</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total NDOT</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Mon</td>
                                    <td class="px-6 py-4 whitespace-nowrap">05/20/2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9am-6pm</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9:13 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">6:18 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">467</td>
                                    <td class="px-6 py-4 whitespace-nowrap">18</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr> 
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Tue</td>
                                    <td class="px-6 py-4 whitespace-nowrap">05/21/2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9am-6pm</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8:42 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">6:05 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">480</td>
                                    <td class="px-6 py-4 whitespace-nowrap">5</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr> 
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Wed</td>
                                    <td class="px-6 py-4 whitespace-nowrap">05/22/2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9am-6pm</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8:44 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">6:03 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">480</td>
                                    <td class="px-6 py-4 whitespace-nowrap">3</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr> 
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Thu</td>
                                    <td class="px-6 py-4 whitespace-nowrap">05/23/2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9am-6pm</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8:19 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">6:03 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">480</td>
                                    <td class="px-6 py-4 whitespace-nowrap">3</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr> 
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">Mon</td>
                                    <td class="px-6 py-4 whitespace-nowrap">05/24/2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">9am-6pm</td>
                                    <td class="px-6 py-4 whitespace-nowrap">8:27 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">6:05 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">480</td>
                                    <td class="px-6 py-4 whitespace-nowrap">5</td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                    <td class="px-6 py-4 whitespace-nowrap"></td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </main>
            
        </div>
    
        <script src="../../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>