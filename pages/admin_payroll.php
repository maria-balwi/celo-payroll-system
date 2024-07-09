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
                Payroll 
                
                <!-- PRINT PAYROLL BUTTON -->
                <div class="static inline-block text-right">
                    <button id="" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-blue-500 hover:bg-blue-500 hover:text-white-500 focus:outline-none">
                    Generate Payroll
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto my-3 overflow-auto">
                    <table id="example" class="table table-striped table-bordered table-auto min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deduction</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Pay</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 whitespace-nowrap">Emuross Dela Rosa</td>
                                <td class="px-6 whitespace-nowrap">PHP 600</td>
                                <td class="px-6 whitespace-nowrap">PHP 1200</td>
                            </tr>
                            <tr>
                                <td class="px-6 whitespace-nowrap">Charlie Fabella Jr.</td>
                                <td class="px-6 whitespace-nowrap">PHP 600</td>
                                <td class="px-6 whitespace-nowrap">PHP 1200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/team_dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>