<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>

        <style>
            video, canvas {
                display: block;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	
 
            <!-- MAIN CONTENT -->
            <main class="flex-1 p-3 overflow-auto">
                <div class="flex-1 p-2 mt-none text-2xl font-bold">
                    Dashboard
                </div>

                <!-- CONTENT -->
                <!-- CARDS -->
                <div class="grid grid-cols-2 md:grid-cols-2 md:grid-cols-5 gap-3 overflow-auto">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-lg col-span-2 shadow-md">
                        <h2 class="text-xl font-bold mb-2">Hi, <?php echo $_SESSION['employeeName'] ?>!</h2>
                        <p class="text-gray-700">It's nice to see you again.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-span-2">
                    </div>

                    <!-- NEW Card 3 -->
                    <button data-bs-toggle="modal" data-bs-target="#faceDTRModal">
                        <div class="bg-white px-4 py-6 rounded-lg shadow-md text-center">
                            <!-- <svg class="h-20 w-20 text-gray-600 mx-auto"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg> -->
                            <svg class="h-32 w-32 text-gray-500 mx-auto"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h2 class="text-xl font-bold px-2">Face DTR</h2>
                        </div>
                    </button>

                    <!-- OLD Card 3 -->
                    <!-- <div class="bg-white p-4 rounded-lg shadow-md text-center">
                        <button data-bs-toggle="modal" data-bs-target="#faceDTRModal">
                            <svg class="h-20 w-20 text-gray-600 mx-auto"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h2 class="text-xl font-bold px-2">Face DTR</h2>
                        </button>
                    </div> -->

                    <!-- Card 4 -->
                    <div class="bg-white px-4 py-8 rounded-lg shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mt-1 mb-0">
                            <?php 
                                $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($_SESSION['id']));
                                $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);
                                echo $monthlyAttendance;
                            ?>
                        </h2>
                        <p class="text-gray-700 text-lg font-semibold">Attendance</p>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white px-4 py-8 rounded-lg shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mt-1 mb-0">
                            <?php 
                                $year = date('Y');
                                $month = date('m');
                                $yearMonth = date('Y-m');

                                $workingDays = $attendance->getWorkingDaysInMonth($yearMonth);
                                $monthlyAttendanceQuery = mysqli_query($conn, $attendance->getMonthlyAttendance($_SESSION['id']));
                                $monthlyAttendance = mysqli_num_rows($monthlyAttendanceQuery);
                                $absences = $workingDays - $monthlyAttendance;
                                echo $absences;
                            ?>
                        </h2>  
                        <p class="text-gray-700 text-lg font-semibold">Absences</p>
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white px-4 py-8 rounded-lg shadow-md text-center my-auto">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mt-1 mb-0">
                            <?php 
                                $monthlyUndertimesQuery = mysqli_query($conn, $attendance->getMonthlyUndertimes($_SESSION['id']));
                                $monthlyUndertimes = mysqli_num_rows($monthlyUndertimesQuery);
                                echo $monthlyUndertimes;
                            ?>
                        </h2>
                        <p class="text-gray-700 text-lg font-semibold">Undertimes</p>
                    </div>

                    <!-- Card 7 -->
                    <div class="bg-white px-4 py-8 rounded-lg shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mt-1 mb-0">
                            <?php 
                                $monthlyLatesQuery = mysqli_query($conn, $attendance->getMonthlyLates($_SESSION['id']));
                                $monthlyLates = mysqli_num_rows($monthlyLatesQuery);
                                echo $monthlyLates;
                            ?>
                        </h2>
                        <p class="text-gray-700 text-lg font-semibold">Tardiness</p>
                    </div>

                    <!-- Card 8 -->
                    <div class="bg-white px-4 py-8 rounded-lg shadow-md text-center">
                        <svg class="h-16 w-16 text-gray-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h2 class="text-xl font-bold mt-1 mb-0">Pending</h2>
                        <p class="text-gray-700 text-lg font-semibold">Leave Days</p>
                    </div>
                </div>


                <!-- ======================================================================================================================================= -->
                <!-- ================================================================= MODAL =============================================================== -->
                <!-- ======================================================================================================================================= -->

                <!--------------------------------------------------------------------------------------------------------------------------------------------->
                <!------------------------------------------------------------------- FACE DTR MODAL ---------------------------------------------------------->
                <div class="modal fade" id="faceDTRModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="userFormLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="faceDTRModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="userFormLabel">Face DTR</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <h2 class="text-xxl font-semibold text-center" id="clock"></h2>
                                    </div>  
                                </div>
                            </div>

                            <div class="modal-footer">
                            <?php if($_SESSION['dtr'] == 'forTimeIn') { ?>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeInModal">Time In</button>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeOutModal">Time Out</button>
                            <?php } else if ($_SESSION['dtr'] == 'forTimeOut') { ?>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeInModal" disabled>Time In</button>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeOutModal">Time Out</button>
                            <?php } else {?>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeInModal" disabled>Time In</button>
                                <button type="button" class="btn btn-primary faceDTR" data-bs-toggle="modal" data-bs-target="#timeOutModal" disabled>Time Out</button>
                            <?php } ?>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--------------------------------------------------------------------------------------------------------------------------------------------->
                <!------------------------------------------------------------------- TIME IN MODAL ----------------------------------------------------------->
                <div class="modal fade" id="timeInModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="timeInModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="timeInModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="timeInModalLabel">Face DTR</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <video id="videoTimeIn" width="640" height="480" autoplay></video>
                                        <canvas id="canvasTimeIn" width="640" height="480" style="display:none;"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="captureTimeIn">Capture</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#faceDTRModal" id="cancelTimeIn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--------------------------------------------------------------------------------------------------------------------------------------------->
                <!------------------------------------------------------------------- TIME OUT MODAL ---------------------------------------------------------->
                <div class="modal fade" id="timeOutModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="timeOutModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-none modal-sm modal-dialog-centered">
                        <div class="modal-content" id="timeOutModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="timeOutModalLabel">Face DTR - Time Out</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <video id="videoTimeOut" width="640" height="480" autoplay></video>
                                        <canvas id="canvasTimeOut" width="640" height="480" style="display:none;"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary " id="captureTimeOut">Capture</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#faceDTRModal" id="cancelTimeOut">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>

        <script src="../assets/js/user_dashboard.js"></script>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>