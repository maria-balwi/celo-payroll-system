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
                    Template
                </div>    

                <!-- REQUEST PRE-RENDER BUTTON -->
                <!-- <div class="relative inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    Request Pre-Render OT
                    </button>
                </div> -->
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overflow-auto">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Hi, Maria Patrice Reyes!</h2>
                        <p class="text-gray-700">It's nice to see you again.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="">
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Face DTR</h2>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Lates</h2>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Absences</h2>
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Undertimes</h2>
                    </div>

                    <!-- Card 7 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Attendance</h2>
                    </div>

                    <!-- Card 8 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold mb-2">Leave Days</h2>
                    </div>
                </div>

                <!-- DATATABLE -->
                <div class="container mx-auto mt-5 overflow-auto">
                    <table id="example" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Office</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">Software Engineer</td>
                                <td class="px-6 py-4 whitespace-nowrap">New York</td>
                                <td class="px-6 py-4 whitespace-nowrap">29</td>
                                <td class="px-6 py-4 whitespace-nowrap">2012/03/29</td>
                                <td class="px-6 py-4 whitespace-nowrap">$120,000</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Jane Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">Software Engineer</td>
                                <td class="px-6 py-4 whitespace-nowrap">New York</td>
                                <td class="px-6 py-4 whitespace-nowrap">29</td>
                                <td class="px-6 py-4 whitespace-nowrap">2012/03/29</td>
                                <td class="px-6 py-4 whitespace-nowrap">$120,000</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Joe Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">Software Engineer</td>
                                <td class="px-6 py-4 whitespace-nowrap">New York</td>
                                <td class="px-6 py-4 whitespace-nowrap">29</td>
                                <td class="px-6 py-4 whitespace-nowrap">2012/03/29</td>
                                <td class="px-6 py-4 whitespace-nowrap">$120,000</td>
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