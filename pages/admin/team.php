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
                    My Team
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="container mx-auto mt-5 overflow-auto">
                    <table id="teamTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Christian Jay Manahan Palencia</td>
                                <td class="px-6 py-4 whitespace-nowrap">christian.palencia@celoph.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">(926) 027-2520</td>
                                <td class="px-6 py-4 whitespace-nowrap">IT</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">John Paul Peliazar Sampang</td>
                                <td class="px-6 py-4 whitespace-nowrap">johnpaul.sampang@celoph.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">(918) 244-8396</td>
                                <td class="px-6 py-4 whitespace-nowrap">IT</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Joseph Paul Gavino Odulio</td>
                                <td class="px-6 py-4 whitespace-nowrap">josephpaul.odulio@celoph.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">(906) 270-3926</td>
                                <td class="px-6 py-4 whitespace-nowrap">IT</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Maria Patrice Alvarez Reyes</td>
                                <td class="px-6 py-4 whitespace-nowrap">patrice.reyes@celoph.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">(991) 657-7916</td>
                                <td class="px-6 py-4 whitespace-nowrap">IT</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
    
        <script src="../../assets/js/team.js"></script>

        <!-- FOOTER -->
        <?php include('../../includes/footer.php'); ?>
    </body>
</html>