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
            body {
                font-family: Arial;
            }

            /* .legend {
                margin: 15px 0;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .legend-item {
                display: flex;
                align-items: center;
                font-size: 12px;
            }

            .box {
                width: 15px;
                height: 15px;
                display: inline-block;
                margin-right: 5px;
                border-radius: 3px;
            } */

            .legend-container {
                margin-top: 20px;
                padding: 15px;
                background: #f9fafb;
                border: 1px solid #e5e7eb;
                border-radius: 10px;
            }

            .legend-container h3 {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .legend-group {
                margin-bottom: 10px;
            }

            .legend-title {
                display: block;
                font-weight: 600;
                margin-bottom: 5px;
                color: #374151;
            }

            .legend-items {
                display: flex;
                flex-wrap: wrap;
                gap: 10px 15px;
            }

            .legend-items span {
                display: flex;
                align-items: center;
                font-size: 12px;
                color: #4b5563;
            }

            .box {
                width: 14px;
                height: 14px;
                margin-right: 6px;
                border-radius: 3px;
                display: inline-block;
            }

            /* Calendar Table */
            .calendar {
                width: 100%;
                border-collapse: collapse;
            }

            .calendar th {
                background: #f5f5f5;
                padding: 10px;
            }

            .calendar td {
                height: 100px;
                vertical-align: top;
                border: 1px solid #ddd;
                padding: 5px;
                position: relative;
            }

            /* Day Number */
            .day-number {
                font-weight: bold;
            }

            /* Labels */
            .label {
                display: block;
                padding: 2px 5px;
                margin-top: 3px;
                color: #fff;
                font-size: 11px;
                border-radius: 3px;
            }

            /* Color Codes */
            /* .att { background: #db3f34; }  Attendance */
            .absent { background: #EF4444; }   /* Red */
            .late { background: #F97316; } 
            .undertime { background: #92400E; }
            .sl-paid { background: #2ecc71; }    /* Sick Leave - Paid */
            .sl-unpaid { background: #EAB308; }    /* Sick Leave - Unpaid */
            /* .sl-unpaid { border: solid #FFD966 2px; color: #000 }  */
            .vl-paid { background: #3498db; }    /* Vacation Leave - Paid */
            .vl-unpaid { background: #674EA7; }    /* Vacation Leave - Unpaid */
            .bl { background: #374151; }    /* Bereavement Leave */
            .ml { background: #EC4899; }    /* Maternity Leave */
            .ml-solo { background: #F43F5E; }    /* Maternity Leave  - Solo Parent */
            .ml-mis { background: #9CA3AF; }    /* Maternity Leave - Miscarriage */
            .pl { background: #6366F1; }    /* Paternity Leave */
            .spl { background: #14B8A6; }    /* Solo Parent Leave */
            .el { background: #DC2626; }    /* Emergency Leave */
            .off { background: #7f8c8d; }   /* Week Off */
            .ot { background: #FACC15; }    /* Overtime */
        </style>
 
            <!-- MAIN CONTENT -->
            <main class="flex-1 p-3">
                <div class="flex flex-1 p-2 text-2xl font-bold items-center">
                    <div>
                        Daily Time Records
                    </div>    
                </div>

                <!-- CONTENT -->
                <div class="p-4 m-0 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">

                    <input type="month" id="month" value="<?php echo date('Y-m'); ?>">
                    <button onclick="loadCalendar()">Load</button>

                    <table class="calendar">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendarBody"></tbody>
                    </table>   

                    <div class="legend-container">
                        <h3>Legend</h3>

                        <div class="legend-group">
                            <span class="legend-title">Attendance</span>
                            <div class="legend-items">
                                <span><i class="box absent"></i> Absent</span>
                                <span><i class="box late"></i> Late</span>
                                <span><i class="box undertime"></i> Undertime</span>
                                <span><i class="box ot"></i> Overtime</span>
                            </div>
                        </div>

                        <div class="legend-group">
                            <span class="legend-title">Leaves</span>
                            <div class="legend-items">
                                <span><i class="box sl-paid"></i> SL Paid</span>
                                <span><i class="box sl-unpaid"></i> SL Unpaid</span>
                                <span><i class="box vl-paid"></i> VL Paid</span>
                                <span><i class="box vl-unpaid"></i> VL Unpaid</span>
                                <span><i class="box bl"></i> Bereavement</span>
                                <span><i class="box el"></i> Emergency</span>
                            </div>
                            <div class="legend-items">
                                <span><i class="box ml"></i> Maternity</span>
                                <span><i class="box ml-solo"></i> Maternity - Solo</span>
                                <span><i class="box ml-mis"></i> Maternity - Miscarriage</span>
                                <span><i class="box pl"></i> Paternity</span>
                                <span><i class="box spl"></i> Solo Parent</span>
                            </div>
                        </div>

                        <div class="legend-group">
                            <span class="legend-title">Others</span>
                            <div class="legend-items">
                                <span><i class="box off"></i> Week Off</span>
                            </div>
                        </div>
                    </div>

                </div>  
            </main>
            
        </div>
    
        <script src="../assets/js/dtr.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>