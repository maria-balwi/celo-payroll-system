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
        <main class="flex-1 p-3">
            <div class="flex flex-1 px-4 pb-2 text-2xl font-bold justify-between items-center">
                <div>
                    Profile Section
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="flex overflow-auto justify-center">
                <div class="container mx-auto">
                    <div class="grid grid-cols-12 md:grid-cols-12 gap-3">

                        <?php
                            $userQuery = mysqli_query($conn, $users->viewUser($_SESSION['id']));
                            while ($userDetails = mysqli_fetch_array($userQuery)) {
                        ?>

                        <!-- LEFT CARD -->
                        <div class="col-span-12 md:col-span-4">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/men/94.jpg" class="w-32 h-32 bg-gray-300 rounded-md mb-4 shrink-0">

                                    </img>
                                    <h1 class="text-lg font-bold uppercase"><?php echo $userDetails['employeeName'] ?></h1>
                                    <p class=" text-sm  uppercase text-gray-700"><?php echo $userDetails['departmentName']." - ". $userDetails['position'] ?></p>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <div class="flex flex-col py-1">
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Email:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['emailAddress'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Mobile:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['mobileNumber'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Department:</h2>
                                        <h2 class="text-sm text-gray-400"><?php echo $userDetails['departmentName'] ?></h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-black-400 hover:bg-blue-500 hover:text-white focus:outline-none">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT CARD -->
                        <div class="col-span-12 md:col-span-8">
                            <div class="bg-white shadow rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 justify-center">
                                <div>
                                    <h2 class="text-lg font-bold">Personal Information</h2>
                                    <div class="flex flex-col py-1 pr-6">
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Name:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['employeeName'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Email:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['emailAddress'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Address:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['address'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Mobile:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['mobileNumber'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Birthday:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['dateOfBirth'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Gender:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['gender'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Place of Birth:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['placeOfBirth'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Civil Status:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['civilStatus'] ?></h2>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold">Employment Information</h2>
                                    <div class="flex flex-col py-1">
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Job Title:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['departmentName']." - ". $userDetails['position'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Date Hired:</h2>
                                            <h2 class="text-sm text-gray-400">January 8, 2024</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">SSS No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['SSS'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Pag-Ibig No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['pagIbig'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Philhealth No.:</h2>
                                            <h2 class="text-sm text-gray-400"><?php echo $userDetails['philhealth'] ?></h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Shift:</h2>
                                            <h2 class="text-sm text-gray-400">9am - 6pm</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
        </main>
    
        <script src="../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>