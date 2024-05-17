<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- TAILWIND CSS -->
        <link href="assets/styles/output.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- SWEET ALERT 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
    </head>
    <body class="bg-gray-100 h-screen flex">

        <!-- Sidebar -->
        <div class="bg-gray-800 text-gray-100 w-64 space-y-6 py-7 px-2 flex-shrink-0">
            <!-- Logo -->
            <a href="#" class="text-white flex items-center space-x-2 px-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v2H5v-2a2 2 0 012-2h2a2 2 0 012 2zM9 7v6m0 0v6m0-6H3m6 0h12M9 3h12M9 7H3m12 0h6M9 7V3m0 4h12"></path></svg>
                <span class="text-xl font-extrabold">Payroll System</span>
            </a>
            
            <!-- Navigation -->
            <nav>
                <hr>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Dashboard
                </a>
                <hr>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Daily Time Record
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Payslip
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
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
            
            <!-- Navbar -->
            <div class="bg-gray-800 p-4 flex justify-between items-center shadow">
                <div class="text-lg font-semibold"></div>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="bg-white px-4 py-2 rounded">
                        User
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200" id="btnLogout">Logout</a>
                    </div>
                </div>
            </div>

        <script>
            function toggleDropdown() {
                document.getElementById('dropdown').classList.toggle('hidden');
            }
        </script>
    </body>
</html>