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
            /* .att { background: #db3f34; }   /* Attendance  */
            .absent { background: #db3f34; }   /* Red */
            .late { background: #f1c40f; color: black; } 
            .undertime { background: #d35400; }
            .vl { background: #3498db; }    /* Vacation Leave */
            .sl { background: #2ecc71; }    /* Sick Leave */
            .bl { background: #713600; }    /* Bereavement Leave */
            .ot { background: #a0512d; }    /* Overtime */
            .off { background: #7f8c8d; }   /* Week Off */
            .holiday { background: #16a085; } /* Holiday */
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

                </div>  
            </main>
            
        </div>
    
        <script src="../assets/js/dtr.js?v=<?php echo $version; ?>"></script>

        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>