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

                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-20 w-20 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">Face DTR</h2>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">4</h2>
                        <p class="text-gray-700">Attendance</p>
                    </div>

                    <!-- Card 5 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">2</h2>
                        <p class="text-gray-700">Absences</p>
                    </div>

                    <!-- Card 6 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">1</h2>
                        <p class="text-gray-700">Undertimes</p>
                    </div>

                    <!-- Card 7 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">1</h2>
                        <p class="text-gray-700">Tardiness</p>
                    </div>

                    <!-- Card 8 -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <svg class="h-16 w-16 text-gray-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h2 class="text-xl font-bold mb-2">1</h2>
                        <p class="text-gray-700">Leave Days</p>
                    </div>
                </div>
            </main>
            
        </div>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>