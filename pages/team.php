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
                    My Team
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto overflow-auto">
                    <table id="teamTable" class="table min-w-full divide-y divide-gray-200 table-striped table-bordered">
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
                                $teamQuery = mysqli_query($conn, $employees->viewTeam());
                                while ($teamDetails = mysqli_fetch_array($teamQuery)) {

                                    $team_id = $teamDetails['id'];
                                    $team_employeeName = $teamDetails['employeeName'];
                                    $team_emailAddress = $teamDetails['emailAddress'];
                                    $team_mobileNumber = $teamDetails['mobileNumber'];
                                    $team_department = $teamDetails['departmentName'];


                                    echo "<tr data-id='" . $team_id . "' class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_employeeName . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_emailAddress . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_mobileNumber . "</td>";
                                    echo "<td ='px-6 whitespace-nowrap'>" . $team_department . "</td>";
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