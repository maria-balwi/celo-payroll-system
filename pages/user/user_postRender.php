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
            <div class="flex-1 p-2 text-2xl font-bold">
                Post-Render Overtime
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATA TABLE -->
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
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-1</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-2</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-3</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-4</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-5</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-6</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-7</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-8</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-9</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 1-10</td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-1</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-2</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-3</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-4</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-5</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-6</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-7</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-8</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-9</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 2-10</td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-1</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-2</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-3</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-4</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-5</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-6</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-7</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-8</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-9</td>
                                <td class="px-6 py-4 whitespace-nowrap">RC 3-10</td>
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