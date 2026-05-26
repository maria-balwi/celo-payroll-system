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
                transform: scale(0.45);
                transform-origin: top left; 
                width: 100%; 
                height: auto; 
                overflow: hidden; 
            }

            /* .watermark {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0.1;
                pointer-events: none;
                z-index: 1;
            }

            .watermark img {
                max-width: 25%;
                opacity: 0.2;
            }

            .watermark p {
                color: gray;
                font-weight: bold;
                margin-top: 10px;
                font-size: 14px;
                text-align: center;
            }

            .payslip-container {
                position: relative;
                background: white;
                z-index: 10;
            } */
        </style>
 
        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3">
            <div class="flex-1 p-2 text-2xl font-bold">
                Payslip

                <!-- PAYSLIP CYCLYE RANGE FROM DROPDOWN MENU -->
                <div class="static inline-block text-right">
                    <select id="payrollCycleID" class="form-select inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 bg-white text-sm font-medium text-gray-700">
                        <option disabled selected>Select Payroll Cycle</option>
                        <?php
                            function formatDate($date) {
                                // GET CURRENT YEAR
                                $currentYear = date('Y');

                                // APPEND THE CURRENT YEAR TO THE INPUT DATE
                                $dateWithYear = $date . '-' . $currentYear;

                                // CREATE DATETIME OBJECT FROM THE STRING AND RETURN THE FORMATTED DATE
                                $dateTime = DateTime::createFromFormat('m-d-Y', $dateWithYear);

                                return $dateTime->format('Y-m-d');
                            }

                            function formatPayrollCycleDate($conn, $payroll, $payrollCycleID) {
                                $payrollCycleQuery = mysqli_query($conn, $payroll->viewPayrollCycle($payrollCycleID));
                                while ($payrollCycleDetails = mysqli_fetch_array($payrollCycleQuery)) {
                                    $from = $payrollCycleDetails['payrollCycleFrom'];
                                    $to = $payrollCycleDetails['payrollCycleTo'];
                                    
                                    // GET CURRENT YEAR
                                    $year = date('Y');
                                    if ($payrollCycleID == 1) {
                                        $year = date('Y') - 1;
                                    }

                                    $fromDate = $from . '-' . $year;
                                    $toDate = $to . '-' . $year;
                                    
                                    // SET THE YEAR FOR BOTH DATES
                                    $fromDate = DateTime::createFromFormat('m-d-Y', $fromDate);
                                    $toDate = DateTime::createFromFormat('m-d-Y', $toDate);
                                }
                            
                                // Format the date
                                return $fromDate->format('M d, Y') . ' to ' . $toDate->format('M d, Y');
                            }

                            $availablePayslips = mysqli_query($conn, $payroll->viewAvailablePayslips());
                            while ($payslipResult = mysqli_fetch_array($availablePayslips)) {
                            ?>
                            <option value="<?php echo $payslipResult['payrollCycleID']; ?>">
                                <?php echo formatPayrollCycleDate($conn, $payroll, $payslipResult['payrollCycleID']); ?>
                            </option>
                            
                        <?php        
                            }
                        ?>
                    </select>
                </div>

                 <!-- GENERATE PAYSLIP CHANGE BUTTON -->
                 <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none generatePayslip" data-id="<?php echo $_SESSION['designationID'] ?>">
                    Generate Payslip
                    </button>
                </div>

                <!-- PRINT PAYSLIP CHANGE BUTTON
                <div class="static inline-block text-right">
                    <button class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-blue-500 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none printPayslip" id="btnPrintPayslip">
                    Print Payslip
                    </button>
                </div> -->

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
                    <div id="payslipContainer" class="relative col-span-12 md:col-span-4 table text-center table-auto">
                    </div>
                </div>

            </div>
        </main>
    
        <script src="../assets/js/user_payslip.js?v=<?php echo $version; ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>