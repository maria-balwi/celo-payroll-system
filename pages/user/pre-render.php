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
        <main class="flex-1 p-3">
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                <div>
                    Pre-Render Overtime Requests
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="pre_render_form.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Request Pre-Render OT</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATA TABLE -->
                <div class="container mx-auto mt-5 overflow-auto">
                    <table id="example" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OT Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">05/21/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">05/20/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">1 HR</td>
                                <td class="px-6 py-4 whitespace-nowrap">Meeting</td>
                                <td class="px-6 py-4 whitespace-nowrap">Pending</td>
                                <td class="px-6 py-4 whitespace-nowrap">Action</td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">04/30/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">04/30/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">1 HR</td>
                                <td class="px-6 py-4 whitespace-nowrap">Meeting</td>
                                <td class="px-6 py-4 whitespace-nowrap">Approved</td>
                                <td class="px-6 py-4 whitespace-nowrap">Action</td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">03/27/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">03/27/2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">2 HRS</td>
                                <td class="px-6 py-4 whitespace-nowrap">Meeting</td>
                                <td class="px-6 py-4 whitespace-nowrap">Approved</td>
                                <td class="px-6 py-4 whitespace-nowrap">Action</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>