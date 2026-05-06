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
                    if (($_SESSION['levelID'] == '3' || $_SESSION['levelID'] == '0') && $_SESSION['activated'] == 1) { // ADMIN & HR SUPERVISOR LEVEL
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Admin's Portal</h4>
                </div>
                <a href="../pages/admin_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Dashboard
                </a>
                <a href="../pages/admin_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Records
                </a>
                <a href="../pages/admin_employees.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Employee List
                </a>
                <?php
                    if ($_SESSION['designationID'] != '8') { // ONLY FOR FINANCE STAFF
                ?>
                <a href="../pages/admin_users.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    User List
                </a>
                <?php
                    }
                ?>
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
                <a href="../pages/admin_cashAdvance.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Cash Advances
                </a>
                <a href="../pages/admin_adjustments.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Adjustments
                </a>
                <a href="../pages/admin_disputes.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Disputes
                </a>
                <a href="../pages/admin_payroll.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Payroll
                </a>
                <a href="../pages/admin_notifications.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Memo
                </a>
                <?php
                    if ($_SESSION['departmentID'] == '5' || $_SESSION['levelID'] == '3' || $_SESSION['levelID'] == '0') {
                ?>
                <a href="../pages/admin_auditTrail.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Audit Trail
                </a>
                <?php }
                    }
                    if ($_SESSION['levelID'] == '4' && $_SESSION['activated'] == 1) { // HR & ADMIN STAFF LEVEL
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
                    if ($_SESSION['levelID'] == '5' && $_SESSION['activated'] == 1) { // HR GENERALIST LEVEL
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">Admin's Portal</h4>
                </div>
                <a href="../pages/admin_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Dashboard
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
                <a href="../pages/admin_disputes.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Disputes
                </a>
                <?php }
                    if ($_SESSION['levelID'] == '2' && $_SESSION['activated'] == 1) { // TEAM LEAD & IT SUPERVISOR & MANAGER LEVEL
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
                <a href="../pages/team_cashAdvance.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Cash Advance
                </a>
                <a href="../pages/team_disputes.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Disputes
                </a>
                <?php if ($_SESSION['departmentID'] == '4') { ?>
                <a href="../pages/admin_users.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    User List
                </a>
                <?php } ?>
                <?php 
                    }
                    // ALL USERS
                    if (($_SESSION['levelID'] == '1' || $_SESSION['levelID'] == '2' || $_SESSION['levelID'] == '3' || $_SESSION['levelID'] == '4' || $_SESSION['levelID'] == '5' || $_SESSION['levelID'] == '6' || $_SESSION['levelID'] == '0') && $_SESSION['activated'] == 1) {
                ?>
                <div class="menu-section">
                    <h4 class="text-sm font-bold text-gray-500 uppercase pt-2 pb-2">My Portal</h4>
                </div>
                <a href="../pages/user_dashboard.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Dashboard
                </a>
                <!-- <a href="../pages/user_dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Daily Time Record
                </a> -->
                <a href="../pages/dtr.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Calendar DTR
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
                <a href="../pages/user_cashAdvance.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Cash Advance
                </a>
                <a href="../pages/user_disputes.php" class="block py-2.5 px-4 text-white rounded transition duration-200 hover:bg-gray-700 no-underline hover:text-white hover:no-underline">
                    Disputes
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
                    <!-- Bell (clickable) -->
                    <button id="notifBtn" type="button" class="relative align-middle text-gray-800 mr-2">
                        <i class="bi bi-bell text-2xl"></i>

                        <!-- badge -->
                        <span id="notifCount"
                            class="absolute -top-1 -right-2 bg-red-600 text-white text-[10px] rounded-full px-1 py-0 hidden">
                            0
                        </span>
                    </button>

                    <!-- Notifications dropdown (hidden by default) -->
                    <div id="notifDropdown"
                        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg hidden z-50 overflow-hidden">
                        <div class="px-4 py-2 font-semibold border-b">Notifications</div>
                        <div id="notifList" class="max-h-80 overflow-auto" style="max-height: 200px;">
                            <div class="px-4 py-3 text-sm text-gray-500">Loading...</div>
                        </div>
                        <!-- <div class="px-4 py-2 text-xs text-gray-500 border-t text-center">
                            Showing latest 3
                        </div> -->
                    </div>
            
                    <button onclick="toggleDropdown()" class=" text-gray-800 font-bold px-4 py-2">
                        <?php echo $_SESSION['employeeName']; ?> 
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        <a href="../pages/profile.php" class="block px-4 py-2 text-gray-800 hover:text-gray-800 no-underline hover:bg-gray-200 hover:no-underline">Profile</a>
                        <a class="block px-4 py-2 text-gray-800 no-underline hover:bg-gray-200" id="btnLogout">Logout</a>
                    </div>
                </div>
            </div>

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------- VIEW NOTIFICATION MODAL --------------------------------------------------------->
            <div class="modal fade" id="viewNotifModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Notification</h1>
                            <input type="hidden" id="view_notificationID">
                        </div>
                        
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="view_dateCreated">Date Created:</label>
                                </div>
                                <div class="col-4">
                                    <label for="view_title">Name:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="view_dateCreated" name="view_dateCreated" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="view_title" name="view_title" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <div id="photo_container" class="w-100 overflow-auto" style="height: 350px;">
                                        <img id="view_profilePhoto"
                                            src=""
                                            alt="Profile Photo"
                                            class="img-thumbnail rounded w-100"
                                            style="height: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_close">Close</button>
                        </div>
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

            function formatDateTime(dateInput) {
                if (!dateInput) return '';

                var jsDate = new Date(dateInput.replace(" ", "T"));

                var datePart = jsDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit'
                });

                var timePart = jsDate.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });

                return datePart + ' ' + timePart;
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

            // NOTIFICATION
            function loadNotifCount() {
                $.getJSON('../backend/user/getNotifCount.php', function (res) {
                    const count = res.count || 0;
                    if (count > 0) {
                        $('#notifCount').text(count).removeClass('hidden');
                    } else {
                        $('#notifCount').addClass('hidden');
                    }
                });
            }

            // DROPDOWN LIST NOTIFICATIONS
            function loadNotifList() {
                $('#notifList').html('<div class="px-4 py-3 text-sm text-gray-500">Loading...</div>');

                $.getJSON('../backend/user/getNotifList.php', function (res) {
                    const items = res.items || [];
                    if (!items.length) {
                        $('#notifList').html('<div class="px-4 py-3 text-sm text-gray-500">No notifications</div>');
                        return;
                    }

                    let html = '';
                    items.forEach(item => {
                        const isNew = item.is_read === 0;

                        html += `
                            <button type="button"
                                    class="notifView w-full text-left px-4 py-3 hover:bg-gray-100 border-b"
                                    data-id="${item.notificationID}"
                                    data-photo="${item.photo_path}"
                                    data-date="${item.created_at}"
                                    data-title="${item.title}"
                                    data-bs-toggle="modal" data-bs-target="#viewNotifModal">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-sm">${item.title}</span>
                                    ${isNew ? '<span class="text-xs bg-blue-600 text-white px-2 py-0.5 rounded-full">new</span>' : ''}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">${formatDateTime(item.created_at)}</div>
                            </button>
                        `;
                    });

                    $('#notifList').html(html);
                });
            }

            // open/close notif dropdown
            $('#notifBtn').on('click', function (e) {
                e.stopPropagation();

                // close user dropdown if open (optional)
                $('#dropdown').addClass('hidden');

                $('#notifDropdown').toggleClass('hidden');

                if (!$('#notifDropdown').hasClass('hidden')) {
                    loadNotifList();
                }
            });

            // VIEW NOTIF MODAL - UPON CLICKING ITEM IN NOTIF LIST DROPDOWN
            $(document).on("click", ".notifView", function () {
                const id = $(this).data("id");
                const photo = $(this).data("photo");
                const date = $(this).data("date");
                const title = $(this).data("title");

                // ASSIGN TO MODAL
                $("#view_notificationID").val(id);
                $("#view_dateCreated").val(formatDateTime(date)); 
                $("#view_title").val(title); 
                $("#view_profilePhoto").attr("src", photo);

                $.ajax({
                    url: "../backend/user/markNotifRead.php",
                    type: "POST",
                    dataType: "json",
                    data: { notificationID: id },
                    success: function (res) {
                        if (res.error === 0) {
                            loadNotifCount();
                            loadNotifList();
                        }
                        else {
                            console.log(res.em);
                        }
                    }, 
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // close dropdown if click outside
            $(document).on('click', function () {
                $('#notifDropdown').addClass('hidden');
            });

            $(document).on('click', function (e) {
                if (!$(e.target).closest('#notifDropdown, #notifBtn').length) {
                    $('#notifDropdown').addClass('hidden');
                }
            });


            // init + polling
            loadNotifCount();
            setInterval(loadNotifCount, 10000);

        </script>

        <script src="../assets/js/sidebar.js"></script>
    </body>
</html>