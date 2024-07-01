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
                    Employees
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="teamTable" class="min-w-full divide-y divide-gray-200 table-striped table-bordered">
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


                                    echo "<tr data-id='" . $employee_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
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
            
        </main>
    
        <script src="../assets/js/team.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>