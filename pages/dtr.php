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
                <div class="flex-1 p-4 text-2xl font-bold overflow-auto">
                    Daily Time Record
                </div>
                <div class="container mx-auto mt-5">
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
            </main>
            
        </div>
    
        <script src="../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>