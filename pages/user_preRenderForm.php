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
                    Pre-Render OT
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="user_preRender.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Back</a>
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
                                        <h1 class="text-lg font-bold uppercase">Request Pre-Render Overtime</h1>
                                    </div>
                                    <hr class="my-2 border-t border-gray-300">
                                    <div class="flex flex-col py-1">
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Overtime Date</h3>
                                            <input type="date" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="flex py-1">
                                            <div class="grid grid-cols-12 w-full gap-2">
                                                <div class="col-span-6">
                                                    <h3 class="text-sm text-gray-600 py-1">OT Start Time</h3>
                                                    <input type="time" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                                <div class="col-span-6">
                                                    <h3 class="text-sm text-gray-600 py-1">OT End Time</h3>
                                                    <input type="time" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Purpose</h3>
                                            <textarea name="" id="" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5"></textarea>
                                        </div>
                                        <div>
                                            <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none" id="btnFileRequest">File Request</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- RIGHT CARD -->
                        <div class="col-span-6 sm:col-span-7">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <h1 class="text-lg font-bold uppercase">Pre-render Overtime Requests</h1>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <!-- DATATABLE -->
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
                        </div>

                    </div>
                </div>
                
            </div>
            
        </main>
    
        <script src="../assets/js/hr_requests.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>