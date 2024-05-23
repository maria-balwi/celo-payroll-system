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
                    <a href="change_shift_form.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Request Shift Change</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto mt-5 overflow-auto">
                    <table id="example" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Effectivity Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason | Remarks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">May 16, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">9am - 6pm</td>
                                <td class="px-6 py-4 whitespace-nowrap">May 20, 2024 - May 26, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">Change shift schedule</td>
                                <td class="px-6 py-4 whitespace-nowrap">Approved</td>
                                <td class="px-6 py-4 whitespace-nowrap">Edit</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">May 26, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">9am - 6pm</td>
                                <td class="px-6 py-4 whitespace-nowrap">May 27, 2024 - June 2, 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">Change shift schedule</td>
                                <td class="px-6 py-4 whitespace-nowrap">Pending</td>
                                <td class="px-6 py-4 whitespace-nowrap">Edit</td>
                            </tr>
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