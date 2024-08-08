$(document).ready(function() {

    $('#payslipTable').DataTable();
    $('#bntPrintPayslip').hide();

    $('#btnGeneratePayslip').click(function(e) {
        $('#loader').show();
        $('#payslipContainer').hide();

        $.ajax({
            url: '../backend/user/generate_payslip.php',
            type: 'POST',
            data: {
                employeeId: 12345 // You can make this dynamic as needed
            },
            success: function(response) {
                $('#loader').hide();
                $('#payslipContainer').html(response).show();
            },
            error: function(xhr, status, error) {
                $('#loader').hide();
                console.error(error);
            }
        });
        $('#bntPrintPayslip').show();
    });

    $("#bntPrintPayslip").click(function (e) {
        e.preventDefault();

        var payslip = document.getElementById("payslip");
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