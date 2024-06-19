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
                    HR Requests
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="hr_requests.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Back</a>
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
                                        <h1 class="text-lg font-bold uppercase">File HR Request</h1>
                                    </div>
                                    <hr class="my-2 border-t border-gray-300">
                                    <div class="flex flex-col py-1">
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Shifts</h3>
                                            <select type="dropdown" class="p-2 text-md border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="1">Value 1</option>
                                                <option value="2">Value 2</option>
                                                <option value="3">Value 3</option>
                                            </select>
                                        </div>
                                        <div class="flex flex-col gap-2 py-1">
                                            <h3 class="text-sm text-gray-600">Effective Dates</h3>
                                            <div class="flex">
                                                <input type="date" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <svg class="h-8 w-8 text-neutral-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                                </svg>
                                                <input type="date" class="w-full p-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                                    <h1 class="text-lg font-bold uppercase">HR Requests</h1>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <!-- DATATABLE -->
                                <div class="container mx-auto mt-5 overflow-auto">
                                <table id="example" class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purpose | Details</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attachments</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">May 16, 2024</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Change Rest Day Request</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Please set my week off to May 18 and 19 for this week.</td>
                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                            <td class="px-6 py-4 whitespace-nowrap">Approved</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">May 20, 2024</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Change Rest Day Request</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Please set my week off to May 25 and 26 for this week.</td>
                                            <td class="px-6 py-4 whitespace-nowrap"></td>
                                            <td class="px-6 py-4 whitespace-nowrap">Approved</td>
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
    
        <script src="../../assets/js/hr_requests.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>