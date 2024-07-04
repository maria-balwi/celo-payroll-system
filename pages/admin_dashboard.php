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
                <div class="flex-1 p-2 mt-none text-2xl font-bold">
                    Admin Dashboard
                </div>

                <!-- CONTENT -->
                <!-- CARDS -->
                <div class="grid grid-cols-6 md:grid-cols-6 gap-3 overflow-auto">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-2 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">4</h2>
                        <p class="text-gray-700">Total Employees</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">4</h2>
                        <p class="text-gray-700">Present</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">0</h2>
                        <p class="text-gray-700">Absent</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">2</h2>
                        <p class="text-gray-700">Late</p>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white p-4 rounded-lg col-span-3 lg:col-span-1 shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">0</h2>
                        <p class="text-gray-700">On Leave</p>
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-2 shadow-md">
                        <h2 class="text-xl font-bold mb-2">Pending Requests</h2>
                    </div>

                    <!-- Card 7 -->
                    <div class="bg-white p-4 rounded-lg col-span-6 lg:col-span-4 shadow-md">
                        <h2 class="text-xl font-bold mb-2">Recently Added Employees</h2>
                        <!-- DATATABLE -->
                        <div class="container mx-auto overflow-auto">
                            <table id="recentlyAddedEmployeesTable" class="table table-striped table-bordered">
                            <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                        $employeeQuery = mysqli_query($conn, $employees->viewEmployees());
                                        while ($employeeDetails = mysqli_fetch_array($employeeQuery)) {

                                            $employee_id = $employeeDetails['id'];
                                            $employee_employeeName = $employeeDetails['employeeName'];
                                            $employee_emailAddress = $employeeDetails['emailAddress'];
                                            $employee_mobileNumber = $employeeDetails['mobileNumber'];
                                            $employee_department = $employeeDetails['departmentName'];


                                            echo "<tr data-id='" . $employee_id . "' class='employeeView'>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_employeeName . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_emailAddress . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_mobileNumber . "</td>";
                                            echo "<td ='px-6 py-4 whitespace-nowrap'>" . $employee_department . "</td>";
                                            echo "</td>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>

        <script src="../assets/js/admin_dashboard.js"></script>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>