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
            <div class="flex-1 p-2 text-2xl font-bold">
                Payslip

                <!-- DROPDOWN MENU -->
                <div class="relative inline-block text-right">
                    <button id="dropdownButton" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                    Options
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                    </svg>
                    </button>
                    <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Account settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Support</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">License</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATA TABLE -->
                <div class="container mx-auto mt-5">
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
    
        <script src="../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>