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
                    Pre-Render Overtime Requests
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <div class="static inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="user_preRenderForm.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline">Request Pre-Render OT</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATA TABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="example" class="table table-striped table-bordered min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Date Filed</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">OT Date</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">OT Time</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="">05/21/2024</td>
                                <td class="">05/20/2024</td>
                                <td class="">1 HR</td>
                                <td class="">Meeting</td>
                                <td class="">Pending</td>
                                <td class="">Action</td>
                            </tr>

                            <tr>
                                <td class="">04/30/2024</td>
                                <td class="">04/30/2024</td>
                                <td class="">1 HR</td>
                                <td class="">Meeting</td>
                                <td class="">Approved</td>
                                <td class="">Action</td>
                            </tr>

                            <tr>
                                <td class="">03/27/2024</td>
                                <td class="">03/27/2024</td>
                                <td class="">2 HRS</td>
                                <td class="">Meeting</td>
                                <td class="">Approved</td>
                                <td class="">Action</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>