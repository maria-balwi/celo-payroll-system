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
                    My Shifts
                </div>    

                <!-- REQUEST SHIFT CHANGE BUTTON -->
                <div class="relative inline-block text-right">
                    <!-- <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">
                    File HR Request
                    </button> -->
                    <a href="change_shift_form.php" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none">Request Shift Change</a>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="2xl:max-w-2xl p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                <div id="calendar" class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <button id="prev" class="text-lg font-bold"><svg class="h-8 w-8 text-neutral-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M18 15l-6-6l-6 6h12" transform="rotate(270 12 12)" /></svg></button>
                        <div id="monthYear" class="text-lg font-bold"></div>
                        <button id="next" class="text-lg font-bold"><svg class="h-8 w-8 text-neutral-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M18 15l-6-6l-6 6h12" transform="rotate(90 12 12)" /></svg></button>
                    </div>
                    <div class="grid grid-cols-7 gap-5 text-center">
                        <div class="font-bold">Sun</div>
                        <div class="font-bold">Mon</div>
                        <div class="font-bold">Tue</div>
                        <div class="font-bold">Wed</div>
                        <div class="font-bold">Thu</div>
                        <div class="font-bold">Fri</div>
                        <div class="font-bold">Sat</div>
                    </div>
                    <div id="days" class="grid grid-cols-7 gap-5 text-center mt-2">
                        <!-- Days will be injected here by jQuery -->
                    </div>
                </div>

                <div class="flex gap-4 p-3">
                    <div>Legend:</div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-400">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Rest Day
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Default Shift
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Requested Shift
                    </div>
                    <div class="flex gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-500">
                            <path fill-rule="evenodd" d="M4.5 7.5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9Z" clip-rule="evenodd" />
                        </svg>
                        Plotted Shift
                    </div>
                </div>
            </div>
        </main>
    
        <script src="../assets/js/shifts.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>