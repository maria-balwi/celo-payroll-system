<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tailwind CSS DataTable with jQuery</title>
        
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>

        <div class="container mx-auto mt-10">
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
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </body>
</html>
