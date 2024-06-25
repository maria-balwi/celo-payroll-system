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
    </head>
    <body class="bg-gray-100 h-full flex">

        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-800 text-gray-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 md:flex-shrink-0 transition-transform duration-200 ease-in-out">
            <!-- Logo -->
            <a href="#" class="text-white flex items-center space-x-2 px-4">
                <span class="text-xl font-bold">Payroll System</span>
            </a>
            
            <!-- Navigation -->
            <nav>
                <div class="menu-section">
                    <h4 class="text-primary text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Team's Portal</h4>
                </div>
                <?php
                    if ($_SESSION['user'] == 'admin') {
                ?>
                <a href="../admin/team_dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Team Dashboard
                </a>
                <a href="../admin/team.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    My Team
                </a>
                <a href="../admin/team_dtr.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Daily Time Records
                </a>
                <a href="../admin/team_leaves.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Leave Applications
                </a>
                <div>
                    <button onclick="toggleSubMenu()" class="block w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white focus:outline-none">
                    Overtime
                    <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div id="subMenu" class="submenu-enter overflow-hidden pl-4">
                        <a href="../admin/team_preRender.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Pre-Render OT
                        </a>
                        <a href="../admin/team_postRender.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Post-Render OT
                        </a>
                    </div>
                </div>
                
                <a href="../admin/team_changeShift.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Change Shift Requests
                </a>

                <?php 
                    }
                    if ($_SESSION['user'] == 'user' || $_SESSION['user'] == 'admin') {
                ?>
                <div class="menu-section">
                    <h4 class="text-primary text-sm font-bold text-gray-500 uppercase pt-6 pb-2">My Portal</h4>
                </div>
                <a href="../user/user_dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Dashboard
                </a>
                <a href="../user/user_dtr.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Daily Time Record
                </a>
                <a href="../user/user_payslip.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Payslip
                </a>
                <a href="../user/user_leaves.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Leaves
                </a>
                <div>
                    <button onclick="toggleSubMenu()" class="block w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white focus:outline-none">
                    Overtime
                    <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div id="subMenu" class="submenu-enter overflow-hidden pl-4">
                        <a href="../user/user_preRender.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Pre-Render OT
                        </a>
                        <a href="../user/user_postRender.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                        Post-Render OT
                        </a>
                    </div>
                </div>
                
                <a href="../user/user_shifts.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    My Shifts
                </a>
                <a href="../user/user_changeShift.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    Change Shift
                </a>
                <a href="../user/user_hrRequests.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
                    HR Requests
                </a>

                <?php } ?>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Navbar inside Main Content -->
            <div class="bg-white p-4 flex justify-between items-center shadow md:flex">
                <button onclick="toggleSidebar()" class="text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="text-2xl font-bold px-2">Celo Business Solutions Incorporated</div>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="bg-gray-800 text-white px-4 py-2 rounded">
                        User
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        <a href="../profile.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
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

        <script src="../assets/js/sidebar.js"></script>
    </body>
</html>