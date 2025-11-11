<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../assets/styles/sidebar.css">
    </head>
    <body class="bg-gray-100 h-screen flex">

        <!-- Sidebar -->
        <div id="sidebar" class="bg-gray-800 text-gray-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 md:flex-shrink-0 transition-transform duration-200 ease-in-out">
            <!-- Logo -->
            <a href="#" class="text-white flex items-center space-x-2 px-4 no-underline">
                <span class="text-xl font-bold">Payroll System</span>
            </a>
            
            <!-- Navigation -->
            <nav>
                <?php
                    if (($_SESSION['levelID'] == '3' || $_SESSION['levelID'] == '0') && $_SESSION['activated'] == 1) {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Admin's Portal</h4>
                </div>
                <a href="../pages/admin_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Admin Dashboard
                </a>
                <a href="../pages/admin_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Records
                </a>
                <a href="../pages/admin_employees.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Employee List
                </a>
                <a href="../pages/admin_users.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    User List
                </a>
                <a href="../pages/admin_leaves.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Leave Application
                </a>
                <a href="../pages/admin_changeShift.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Change Shift Request
                </a>
                <a href="../pages/admin_overtime.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Overtime
                </a>
                <a href="../pages/admin_holidays.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Holidays
                </a>
                <a href="../pages/admin_adjustments.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Adjustments
                </a>
                <a href="../pages/admin_payroll.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Payroll
                </a>
                <?php
                    if ($_SESSION['departmentID'] == '5' || $_SESSION['departmentID'] == '4' || $_SESSION['levelID'] == '0') {
                ?>
                <a href="../pages/admin_auditTrail.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Audit Trail
                </a>
                <?php }
                    }
                    if (($_SESSION['levelID'] == '4') && $_SESSION['activated'] == 1) {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Admin's Portal</h4>
                </div>
                <a href="../pages/admin_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Records
                </a>
                <a href="../pages/admin_employees.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Employee List
                </a>
                <?php }
                    if (($_SESSION['departmentID'] == '4') && $_SESSION['activated'] == 1 && $_SESSION['levelID'] != '0') {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Admin's Portal</h4>
                </div>
                <a href="../pages/admin_users.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    User List
                </a>
                <?php }
                    if ($_SESSION['levelID'] == '2' && $_SESSION['activated'] == 1) {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Team's Portal</h4>
                </div>
                <a href="../pages/team_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Team Dashboard
                </a>
                <a href="../pages/team.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    My Team
                </a>
                <a href="../pages/team_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Records
                </a>
                <a href="../pages/team_leaves.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Leave Application
                </a>
                <a href="../pages/team_changeShift.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Change Shift Request
                </a>
                <a href="../pages/team_overtime.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Overtime
                </a>
                <?php 
                    }
                    if (($_SESSION['levelID'] == '1' || $_SESSION['levelID'] == '2' || $_SESSION['levelID'] == '3' || $_SESSION['levelID'] == '4' || $_SESSION['levelID'] == '0') && $_SESSION['activated'] == 1) {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">My Portal</h4>
                </div>
                <a href="../pages/user_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Dashboard
                </a>
                <a href="../pages/user_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Record
                </a>
                <a href="../pages/user_payslip.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Payslip
                </a>
                <a href="../pages/user_leaves.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Leaves
                </a>
                <a href="../pages/user_changeShift.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Change Shifts
                </a>
                <a href="../pages/user_overtime.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Overtime
                </a>
                <?php } ?>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex-col overflow-auto">
            
            <!-- Navbar inside Main Content -->
            <div class="bg-white p-4 flex justify-between items-center shadow md:flex">
                <button onclick="toggleSidebar()" class="text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="text-2xl font-bold px-2">Celo Business Solutions Incorporated</div>
                <div class="relative">
                    <button onclick="toggleDropdown()" class=" text-gray-800 font-bold px-4 py-2">
                        <?php echo $_SESSION['employeeName']; ?> 
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        <a href="../pages/profile.php" class="block px-4 py-2 text-gray-800 hover:text-gray-800 no-underline hover:bg-gray-200 hover:no-underline">Profile</a>
                        <a class="block px-4 py-2 text-gray-800 no-underline hover:bg-gray-200" id="btnLogout">Logout</a>
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

            function toggleAdminSubMenu() {
                const submenu = document.getElementById('admin_subMenu');
                if (submenu.classList.contains('admin-submenu-enter')) {
                    submenu.classList.remove('admin-submenu-enter');
                    submenu.classList.add('admin-submenu-enter-active');
                } else {
                    submenu.classList.remove('admin-submenu-enter-active');
                    submenu.classList.add('admin-submenu-enter');
                }
            }

            function toggleUserSubMenu() {
                const submenu = document.getElementById('user_subMenu');
                if (submenu.classList.contains('user-submenu-enter')) {
                    submenu.classList.remove('user-submenu-enter');
                    submenu.classList.add('user-submenu-enter-active');
                } else {
                    submenu.classList.remove('user-submenu-enter-active');
                    submenu.classList.add('user-submenu-enter');
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