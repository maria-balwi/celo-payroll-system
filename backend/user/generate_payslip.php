<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'];
    
    // Fetch employee data from the database (assuming you have a database setup)
    // $conn = new mysqli('hostname', 'username', 'password', 'database');
    // $result = $conn->query('SELECT * FROM employees WHERE id = $employeeId');
    // $employeeData = $result->fetch_assoc();
    
    // For simplicity, we'll use hardcoded data here
    // $employeeData = [
    //     'name' => 'John Doe',
    //     'position' => 'Software Engineer',
    //     'salary' => 5000,
    //     'deductions' => 500,
    //     'netPay' => 4500,
    //     'payPeriod' => 'July 2024',
    //     'dateIssued' => 'August 8, 2024'
    // ];

    $payslip = "
        <table class='table table-striped table-bordered text-center table-responsive' id='payslipTable'>
            <thead>
                <!-- <tr><th colspan='4'>Jul 11, 2024 - Jul 25, 2025</th></tr> -->
                <tr><th colspan='4'>CELO BUSINES SOLUTIONS, INC.</th></tr>
                <tr><th colspan='4'>65 PANAY AVENUE BARANGAY PALIGSAHAN QUEZON CITY</th></tr>
                <tr><th colspan='4'>PAYSLIP</th></tr>
            </thead>

            <tbody>
                <tr>
                    <td>No.</td>
                    <td>Name</td>
                    <td>Payroll Period</td>
                    <td>Payment Type</td>
                </tr>
                <tr>
                    <td>000-396</td>
                    <td>Reyes, Maria Patrice A.</td>
                    <td>Jul 11, 2024 - Jul 25, 2025</td>
                    <td>Daily Rated</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Basic Pay</td>
                    <td>18,000.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Daily Rate</td>
                    <td>827.59</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Hourly Rate</td>
                    <td>103.45</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>No. of Days</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Total Hours</td>
                    <td>106.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Regular Hours</td>
                    <td>64.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>6,620.69</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Regular Night Diff (15%)</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Regular OT (25%)</td>
                    <td>2.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>258.63</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>RegOT Night Diff</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Rest Day OT</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>RDOT Night Diff</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Special Holiday</td>
                    <td>8.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>1,075.86</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>S.H.day Night Diff</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Holiday</td>
                    <td>32.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>6,620.69</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Holiday Night Diff</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PAY</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='4'>DEDUCTIONS</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>WTAX</td>
                    <td>514.33</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>SSS</td>
                    <td>405.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>PHIC</td>
                    <td>225.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>HDMF</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Advances</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Salary Loan</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Pagibig MPL</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Smart</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Adjustment +,-</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='2'>Net Pay</td>
                    <td>NET PAY</td>
                    <td>13,831.53</td>
                </tr>
                <tr>
                    <td colspan='2'>CASH ADVANCE</td>
                    <td>Total C.A.</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan='2'></td>
                    <td>Balance C.A.</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    ";

    echo $payslip;
}
?>