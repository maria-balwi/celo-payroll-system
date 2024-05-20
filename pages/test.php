<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Ensure the sidebar z-index is higher than other elements */
        #sidebar {
            z-index: 50;
        }
        /* Transition styles for submenu */
        .submenu-enter {
            max-height: 0;
            opacity: 0;
            transform: translateY(-20px);
        }
        .submenu-enter-active {
            max-height: 1000px;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease-in-out;
        }
        .submenu-leave {
            max-height: 1000px;
            opacity: 1;
            transform: translateY(0);
        }
        .submenu-leave-active {
            max-height: 0;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease-in-out;
        }
    </style>
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

        function toggleSubMenu() {
            const submenu = document.getElementById('subMenu');
            if (submenu.classList.contains('submenu-enter')) {
                submenu.classList.remove('submenu-enter');
                submenu.classList.add('submenu-enter-active');
            } else {
                submenu.classList.remove('submenu-enter-active');
                submenu.classList.add('submenu-enter');
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
</head>
<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-gray-800 text-gray-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 md:flex-shrink-0 transition-transform duration-200 ease-in-out">
        <!-- Logo -->
        <a href="#" class="text-white flex items-center space-x-2 px-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v2H5v-2a2 2 0 012-2h2a2 2 0 012 2zM9 7v6m0 0v6m0-6H3m6 0h12M9 3h12M9 7H3m12 0h6M9 7V3m0 4h12"></path></svg>
            <span class="text-2xl font-extrabold">Dashboard</span>
        </a>
        
        <!-- Navigation -->
        <nav>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white bg-gray-700 text-white">
                Dashboard
            </a>
            <div>
                <button onclick="toggleSubMenu()" class="block w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white focus:outline-none">
                    Settings
                    <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div id="subMenu" class="submenu-enter overflow-hidden pl-4">
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        General
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Security
                    </a>
                    <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Notifications
                    </a>
                </div>
            </div>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                Profile
            </a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                Logout
            </a>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Navbar inside Main Content -->
        <div class="bg-white p-4 flex justify-between items-center shadow">
            <button onclick="toggleSidebar()" class="text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="text-lg font-semibold">Dashboard</div>
            <div class="relative">
                <button onclick="toggleDropdown()" class="bg-gray-800 text-white px-4 py-2 rounded">
                    Profile
                </button>
                <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">View Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 text-2xl font-bold overflow-auto">
            Main Content Area
        </div>
        
    </div>

</body>
</html>