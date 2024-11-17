<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	

        <style>
            .scale-for-pdf {
                transform: scale(0.55); /* Scale down to 80% */
                transform-origin: top left; /* Anchor scaling to the top-left corner */
                width: 100%; /* Ensure content remains responsive */
                height: auto; /* Let height adjust naturally */
                overflow: hidden; /* Hide any content that overflows */
            }
        </style>
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex-1 p-2 text-2xl font-bold">
                Payslip

                <!-- PAYSLIP CYCLYE RANGE FROM DROPDOWN MENU -->
                <div class="static inline-block text-right">
                    <select id="payrollCycleID" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 bg-white text-sm font-medium text-gray-700">
                        <!-- <option disabled selected>Select Payroll Cycle FROM</option> -->
                        <option disabled selected>Select Payroll Cycle</option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="1">1 - Dec 26, <?php echo date('Y') - 1; ?> to Jan 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="2">2 - Jan 11, <?php echo date('Y'); ?> to Jan 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="3">3 - Jan 26, <?php echo date('Y'); ?> to Feb 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="4">4 - Feb 11, <?php echo date('Y'); ?> to Feb 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="5">5 - Feb 26, <?php echo date('Y'); ?> to Mar 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="6">6 - Mar 11, <?php echo date('Y'); ?> to Mar 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="7">7 - Mar 26, <?php echo date('Y'); ?> to Apr 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="8">8 - Apr 11, <?php echo date('Y'); ?> to Apr 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="9">9 - Apr 26, <?php echo date('Y'); ?> to May 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="10">10 - May 11, <?php echo date('Y'); ?> to May 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="11">11 - May 26, <?php echo date('Y'); ?> to Jun 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="12">12 - Jun 11, <?php echo date('Y'); ?> to Jun 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="13">13 - Jun 26, <?php echo date('Y'); ?> to Jul 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="14">14 - Jul 11, <?php echo date('Y'); ?> to Jul 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="15">15 - Jul 26, <?php echo date('Y'); ?> to Aug 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="16">16 - Aug 11, <?php echo date('Y'); ?> to Aug 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="17">17 - Aug 26, <?php echo date('Y'); ?> to Sep 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="18">18 - Sep 11, <?php echo date('Y'); ?> to Sep 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="19">19 - Sep 26, <?php echo date('Y'); ?> to Oct 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="20">20 - Oct 11, <?php echo date('Y'); ?> to Oct 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="21">21 - Oct 26, <?php echo date('Y'); ?> to Nov 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="22">22 - Nov 11, <?php echo date('Y'); ?> to Nov 25, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="23">23 - Nov 26, <?php echo date('Y'); ?> to Dec 10, <?php echo date('Y'); ?></option>
                        <option class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" value="24">24 - Dec 11, <?php echo date('Y'); ?> to Dec 25, <?php echo date('Y'); ?></option>
                    </select>
                </div>

                 <!-- GENERATE PAYSLIP CHANGE BUTTON -->
                 <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none generatePayslip">
                    Generate Payslip
                    </button>
                </div>

                <!-- DOWNLOAD PAYSLIP CHANGE BUTTON -->
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none downloadPayslip" id="btnDownloadPayslip">
                    Download Payslip
                    </button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="p-4 m-1 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                
                <div class="container mx-auto overflow-auto">
                    <div class="loader" id="loader"></div>
                    <div id="payslipContainer" class="col-span-12 md:col-span-4 table text-center table-auto">

                    </div>
                </div>

            </div>
        </main>
    
        <script src="../assets/js/user_payslip.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>