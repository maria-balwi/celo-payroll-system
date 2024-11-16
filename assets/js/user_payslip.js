$(document).ready(function() {

    $('#payslipTable').DataTable();
    $('#bntPrintPayslip').hide();

    // $('.generatePayslip').click(function(e) {
    //     $('#loader').show();
    //     $('#payslipContainer').hide();

    //     $.ajax({
    //         url: '../backend/user/generate_payslip.php',
    //         type: 'POST',
    //         data: {
    //             employeeId: 12345 // You can make this dynamic as needed
    //         },
    //         success: function(response) {
    //             $('#loader').hide();
    //             $('#payslipContainer').html(response).show();
    //         },
    //         error: function(xhr, status, error) {
    //             $('#loader').hide();
    //             console.error(error);
    //         }
    //     });
    //     $('#bntPrintPayslip').show();
    // });

    $('.generatePayslip').click(function(e) {
        e.preventDefault();
        var payrollCycleID = $('#payrollCycleID').val();

        if (payrollCycleID == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please select a payroll cycle.',
            });
            return;
        }
        else {
            $('#loader').show();
            $('#payslipContainer').hide();

            $.ajax({
                url: '../backend/user/generatePayslip.php',
                type: 'POST',
                data: {
                    payrollCycleID: payrollCycleID,
                },
                success: function(response) {
                    $('#loader').hide();
                    $('#payslipContainer').html(response).show();
                    $('#bntPrintPayslip').show();
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                }
            });
        }
        
    });

    $(".printPayslip").click(function (e) {
        e.preventDefault();

        var payslip = document.getElementById("payslipContainer");
        var style = "<style>";
        style += "table {width: 100%; border-collapse: collapse;}";
        style += "th, td {border: 1px solid #000; padding: 8px;}";
        style += "</style>";
        var newPrint = window.open("");
        newPrint.document.write('<html><head><title>Payslip</title>');
        newPrint.document.write(style); // Apply the CSS styles
        newPrint.document.write('</head><body>');
        newPrint.document.write(payslip.outerHTML); // Copy table HTML
        newPrint.document.write('</body></html>');
        newPrint.document.close();
        newPrint.print();      
    });
});