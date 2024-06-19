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
                <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                    <div>
                        Leaves
                    </div>    

                    <!-- REQUEST PRE-RENDER BUTTON -->
                    <div class="relative inline-block text-right">
                        <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                        File HR Request
                        </button> -->
                        <a href="leave_form.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">File a Leave</a>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="2xl:max-w-2xl p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <!-- DATATABLE -->
                    <div class="container mx-auto mt-5 overflow-auto">
                        <table id="example" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Leave Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inclusive Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Remarks</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">May 21, 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Leave</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Subleave</td>
                                    <td class="px-6 py-4 whitespace-nowrap">15 days</td>
                                    <td class="px-6 py-4 whitespace-nowrap">May 25, 2024 - May 30, 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Remarks</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Attachments</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Paid</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Pending</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Action</td>
                                </tr>

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">May 21, 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Leave</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Subleave</td>
                                    <td class="px-6 py-4 whitespace-nowrap">15 days</td>
                                    <td class="px-6 py-4 whitespace-nowrap">May 25, 2024 - May 30, 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Remarks</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Attachments</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Paid</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Pending</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Action</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </main>
            
        </div>

        <script src="../../assets/js/leaves.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>