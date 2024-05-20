<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <style>
            /* Ensure the sidebar z-index is higher than other elements */
            #sidebar {
                z-index: 50;
            }
        </style>
    </head>
    <body class="bg-gray-100 h-screen flex">

        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-800 text-gray-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 md:flex-shrink-0 transition-transform duration-200 ease-in-out">
            <!-- Logo -->
            <a href="#" class="text-white flex items-center space-x-2 px-4">
                <span class="text-xl font-bold">Payroll System</span>
            </a>
            
            <!-- Navigation -->
            <nav>
                <a href="../pages/dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Dashboard
                </a>
                <a href="../pages/dtr.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Daily Time Record
                </a>
                <a href="../pages/payslip.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Payslip
                </a>
                <a href="../pages/leaves.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Leaves
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Overtime
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    My Shifts
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Change Shift
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    HR Requests
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Navbar inside Main Content -->
            <div class="bg-white p-4 flex justify-between items-center shadow md:flex">
                <button onclick="toggleSidebar()" class="text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="text-2xl font-bold">Celo Business Solutions Incorporated</div>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="bg-gray-800 text-white px-4 py-2 rounded">
                        User
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200" id="btnLogout">Logout</a>
                    </div>
                </div>
            </div>

        <!-- JS -->
        <script>
            function toggleDropdown() {
                document.getElementById('dropdown').classList.toggle('hidden');
            }

            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('-translate-x-full');
            }

            function closeSidebar(event) {
                const sidebar = document.getElementById('sidebar');
                if (!sidebar.contains(event.target) && !event.target.closest('button')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.addEventListener('click', closeSidebar);
                // Add event listeners to sidebar links to set the active class
                const links = document.querySelectorAll('#sidebar nav a');
                links.forEach(link => {
                    link.addEventListener('click', function() {
                        links.forEach(l => l.classList.remove('bg-gray-700', 'text-white'));
                        this.classList.add('bg-gray-700', 'text-white');
                    });
                });
            });
        </script>

        <script src="../assets/js/sidebar.js"></script>
    </body>
</html>