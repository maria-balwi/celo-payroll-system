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
            <div class="flex flex-1 p-2 text-2xl font-bold justify-between items-center">
                <div>
                    Profile Section
                </div>    
            </div>
            
            <!-- CONTENT -->
            <div class="flex overflow-auto justify-center">
                <div class="container mx-auto">
                    <div class="grid grid-cols-4 sm:grid-cols-12 gap-3">

                        <!-- LEFT CARD -->
                        <div class="col-span-3 sm:col-span-3">
                            <div class="bg-white shadow rounded-lg p-4">
                                <div class="flex flex-col items-center">
                                    <img src="https://randomuser.me/api/portraits/men/94.jpg" class="w-32 h-32 bg-gray-300 rounded-md mb-4 shrink-0">

                                    </img>
                                    <h1 class="text-lg font-bold uppercase">Maria Patrice A. Reyes</h1>
                                    <p class=" text-sm  uppercase text-gray-700">IT Staff</p>
                                </div>
                                <hr class="my-2 border-t border-gray-300">
                                <div class="flex flex-col py-1">
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Email:</h2>
                                        <h2 class="text-sm text-gray-400">patrice.reyes@celoph.com</h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Mobile:</h2>
                                        <h2 class="text-sm text-gray-400">0991 657 7916</h2>
                                    </div>
                                    <div class="flex gap-2 py-1">
                                        <h2 class="text-sm font-bold text-gray-500">Department:</h2>
                                        <h2 class="text-sm text-gray-400">IT</h2>
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
                        <div class="col-span-3 sm:col-span-9">
                            <div class="bg-white shadow rounded-lg p-6 grid grid-cols-2 justify-center">
                                <div>
                                    <h2 class="text-lg font-bold">Personal Information</h2>
                                    <div class="flex flex-col py-1 pr-6">
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Name:</h2>
                                            <h2 class="text-sm text-gray-400">Maria Patrice A. Reyes</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Email:</h2>
                                            <h2 class="text-sm text-gray-400">patrice.reyes@celoph.com</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Address:</h2>
                                            <h2 class="text-sm text-gray-400">403 Romana Subdivision, San Antonio, Biñan City, Laguna 4024</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Mobile:</h2>
                                            <h2 class="text-sm text-gray-400">0991 657 7916</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Birthday:</h2>
                                            <h2 class="text-sm text-gray-400">May 7, 2000</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Gender:</h2>
                                            <h2 class="text-sm text-gray-400">Female</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Place of Birth:</h2>
                                            <h2 class="text-sm text-gray-400">Sta. Rosa City, Laguna</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Civil Status:</h2>
                                            <h2 class="text-sm text-gray-400">Single</h2>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold">Employment Information</h2>
                                    <div class="flex flex-col py-1">
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Job Title:</h2>
                                            <h2 class="text-sm text-gray-400">IT Staff</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Date Hired:</h2>
                                            <h2 class="text-sm text-gray-400">January 8, 2024</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">SSS No.:</h2>
                                            <h2 class="text-sm text-gray-400">04-4466134-8</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Pag-Ibig No.:</h2>
                                            <h2 class="text-sm text-gray-400">1213-3275-4751</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Philhealth No.:</h2>
                                            <h2 class="text-sm text-gray-400">-</h2>
                                        </div>
                                        <div class="flex gap-2 py-1">
                                            <h2 class="text-sm text-gray-500">Shift:</h2>
                                            <h2 class="text-sm text-gray-400">9am - 6pm</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
            
        </main>
    
        <script src="../assets/js/dtr.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>