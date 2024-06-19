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
                    <a href="leaves.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Back</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="flex overflow-auto justify-center">
                <div class="container mx-auto">
                    <div class="grid grid-cols-4 sm:grid-cols-12 gap-3">

                        <!-- LEFT CARD -->
                        <div class="col-span-6 sm:col-span-5">
                            <div class="bg-white shadow rounded-lg p-4">
                                <form id="fileRequestForm">
                                    <div class="flex flex-col items-center">
                                        <h1 class="text-lg font-bold uppercase">File a Leave</h1>
                                    </div>
                                    <hr class="my-2 border-t border-gray-300">
                                    <div class="flex flex-col py-1">
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Leave Type</h3>
                                            <select type="dropdown" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option selected disabled>Choose one of the following</option>
                                                <option value="1">RA No. 9262 - Leave for victims of Violence Against Women and Their Children</option>
                                                <option value="2">RA No. 9710 - Special Leave Benefits for Women</option>
                                                <option value="3">Maternity Leave - Expanded Maternity Leave Law 105 Days</option>
                                                <option value="3">Maternity Leave - Miscarriage and emergency termination of pregnancy</option>
                                            </select>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1 mt-2">
                                            <h3 class="text-sm text-gray-600">Purpose</h3>
                                            <textarea name="" id="" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5"></textarea>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1 mt-2">
                                            <h3 class="text-sm text-gray-600">File Attachments</h3>
                                            <input type="file" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" id="btnFileRequest">File this Leave</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- RIGHT CARD -->
                        <div class="col-span-6 sm:col-span-7">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <h1 class="text-lg font-bold uppercase">Available Leave</h1>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <!-- DATATABLE -->
                                <div class="container mx-auto mt-5 overflow-auto">
                                    <table id="example" class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Onhold</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overall</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Default</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Starting</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Overall</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                <td class="px-6 py-4 whitespace-nowrap">10</td>
                                                <td class="px-6 py-4 whitespace-nowrap">10</td>
                                                <td class="px-6 py-4 whitespace-nowrap">N/A</td>
                                                <td class="px-6 py-4 whitespace-nowrap">10</td>
                                                <td class="px-6 py-4 whitespace-nowrap">RA No. 9262 - Leave for victims of Violence Against Women and Their Children</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">N/A</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">RA No. 9710 - Special Leave Benefits for Women</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                <td class="px-6 py-4 whitespace-nowrap">105</td>
                                                <td class="px-6 py-4 whitespace-nowrap">105</td>
                                                <td class="px-6 py-4 whitespace-nowrap">N/A</td>
                                                <td class="px-6 py-4 whitespace-nowrap">105</td>
                                                <td class="px-6 py-4 whitespace-nowrap">Maternity Leave - Expanded Maternity Leave Law 105 Days</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">N/A</td>
                                                <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                <td class="px-6 py-4 whitespace-nowrap">Maternity Leave - Miscarriage and emergency termination of pregnancy</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
            
        </main>
    
        <script src="../../assets/js/leaves.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>