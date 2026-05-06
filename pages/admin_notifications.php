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
        <main class="flex-1 p-3 overflow-auto">
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                <div>
                    Memo
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none no-underline" data-bs-toggle="modal" data-bs-target="#addNotificationModal">Add Memo</button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="px-3 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <!-- DATATABLE -->
                <div class="mx-auto my-3 overflow-auto">
                    <table id="notificationsTable" class="table table-auto table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Created</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Created by</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Read</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Unread</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                function formatDate($date) {
                                    // Create a DateTime object from the string
                                    $dateTime = new DateTime($date);
                                
                                    // Format the date
                                    return $dateTime->format('M d, Y');
                                }

                                $notificationQuery = mysqli_query($conn, $employees->viewNotifications());
                                while ($notificationDetails = mysqli_fetch_array($notificationQuery)) {

                                    $notification_id = $notificationDetails['notificationID'];
                                    $notification_title = $notificationDetails['title'];
                                    $notification_employeeName = $notificationDetails['firstName'] . " " . $notificationDetails['lastName'];
                                    $notification_createdAt = $notificationDetails['created_at'];

                                    $employeeReadNotifCountQuery = mysqli_query($conn, $employees->viewReadNotifications($notification_id));
                                    $employeeReadNotifCount = mysqli_num_rows($employeeReadNotifCountQuery);
                                    $employeeUnreadNotifCountQuery = mysqli_query($conn, $employees->viewUnreadNotifications($notification_id));
                                    $employeeUnreadNotifCount = mysqli_num_rows($employeeUnreadNotifCountQuery);

                                    echo "<tr data-id='" . $notification_id . "' class='notificationView cursor-pointer'>";
                                    echo "<td class ='whitespace-nowrap'>" . formatDate($notification_createdAt) . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $notification_title . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $notification_employeeName . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $employeeReadNotifCount . "</td>";
                                    echo "<td class ='whitespace-nowrap'>" . $employeeUnreadNotifCount . "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ======================================================================================================================================= -->
            <!-- ================================================================= MODAL =============================================================== -->
            <!-- ======================================================================================================================================= -->

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!--------------------------------------------------------- ADD NOTIFICATION MODAL ------------------------------------------------------------>
            <form id="addNotificationForm" enctype="multipart/form-data">
                <div class="modal fade" id="addNotificationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="addNotificationModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Add Notification</h1>
                            </div>

                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="notificationName">Subject:</label>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="notificationName" name="notificationName" required>
                                    </div>
                                </div>

                                <div class="row g-2 mb-1">
                                    <div class="col-12">
                                        <label for="notificationPhoto">Photo:</label>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <input type="file" class="form-control" id="notificationPhoto" name="notificationPhoto" accept="image/png, image/jpeg, image/jpg" required>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------- VIEW NOTIFICATION MODAL --------------------------------------------------------->
            <div class="modal fade" id="viewNotificationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="userFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-none modal-lg modal-dialog-centered">
                    <div class="modal-content" id="viewNotificationModal">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="userFormLabel">View Notification</h1>
                            <input type="hidden" id="viewNotificationID">
                        </div>
                        
                        <div class="modal-body">
                            <div class="row g-2 mb-1">
                                <div class="col-4">
                                    <label for="viewDateCreated">Date Created:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewTitle">Subject:</label>
                                </div>
                                <div class="col-4">
                                    <label for="viewCreatedBy">Posted by:</label>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewDateCreated" name="viewDateCreated" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewTitle" name="viewTitle" disabled readonly>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="viewCreatedBy" name="viewCreatedBy" disabled readonly>
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <div class="col-12">
                                    <div id="photoContainer" class="w-100 overflow-auto" style="height: 350px;">
                                        <img id="viewProfilePhoto"
                                            src=""
                                            alt="Profile Photo"
                                            class="img-thumbnail rounded w-100"
                                            style="height: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <table id="notificationReadTable" class="table table-auto table-striped table-bordered min-w-full divide-y divide-gray-200 text-center pt-3">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Employee Name</th>
                                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="notificationReadTableBody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary notificationUpdate">Update</button>
                            <button type="button" class="btn btn-danger notificationDelete">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------------------------------------------------------------------------------------------------------------->
            <!------------------------------------------------------ UPDATE NOTIFICATION MODAL ------------------------------------------------------------>
            <form id="updateNotificationForm">
                <div class="modal fade" id="updateNotificationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-lg modal-dialog-centered">
                        <div class="modal-content" id="updateNotificationModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Update Holiday</h1>
                                <input type="hidden" id="updateNotificationID" name="updateNotificationID">
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-1">
                                    <div class="col-4">
                                        <label for="updateDateCreated">Date Created:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateTitle">Subject:</label>
                                    </div>
                                    <div class="col-4">
                                        <label for="updateCreatedBy">Posted by:</label>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateDateCreated" name="updateDateCreated" disabled readonly>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateTitle" name="updateTitle">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="updateCreatedBy" name="updateCreatedBy" disabled readonly>
                                    </div>
                                </div>

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <div id="photoContainer" class="w-100 overflow-auto" style="height: 350px;">
                                            <img id="updateMemoPhoto"
                                                src=""
                                                alt="Profile Photo"
                                                class="img-thumbnail rounded w-100"
                                                style="height: auto;">
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <input type="file" class="form-control" id="uploadPhoto" name="uploadPhoto" accept="image/jpeg, image/png, image/jpg">
                                    </div>
                                    <div class="col-1 py-auto">
                                        <i class="bi bi-x"></i>
                                    </div>
                                </div> -->
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <div class="position-relative">
                                        <input
                                            type="file"
                                            class="form-control pe-5"
                                            id="uploadPhoto"
                                            name="uploadPhoto"
                                            accept="image/jpeg, image/png, image/jpg"
                                        >

                                        <!-- Clear button -->
                                        <button
                                            type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent"
                                            id="removeButton"
                                        >
                                            <i class="bi bi-x fs-4"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewNotificationModal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    
        <script src="../assets/js/admin_notifications.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>