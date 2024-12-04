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
                <div>Audit Trail</div>    
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- DATATABLE -->
                <div class="mx-auto my-3 overflow-auto">
                    <table id="auditTrailTable" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Affected Employe</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                                function formatDate($date) {
                                    // Create a DateTime object from the string
                                    $dateTime = new DateTime($date);
                                
                                    // Format the date
                                    return $dateTime->format('F j, Y');
                                }

                                $query = mysqli_query($conn, $employees->viewAuditTrail());
                                while ($auditTrailDetails = mysqli_fetch_array($query)) {

                                    $auditTrailID = $auditTrailDetails['auditTrailID'];
                                    $date = $auditTrailDetails['date'];
                                    $employeeName = $auditTrailDetails['firstName'] . " " . $auditTrailDetails['lastName'];
                                    $module = $auditTrailDetails['module'];
                                    $action = $auditTrailDetails['action'];
                                    $affected_user = $auditTrailDetails['affectedFirstName'] . " " . $auditTrailDetails['affectedLastName'];
                                    $date = formatDate($date);

                                    echo "<tr>";
                                    echo "<td class ='whitespace-nowrap'>" . $auditTrailID . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $date . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $employeeName . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $module . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $action . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $affected_user . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/admin_auditTrail.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>