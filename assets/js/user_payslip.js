$(document).ready(function() {

    $('#payslipTable').DataTable();
    $('#btnDownloadPayslip').hide();

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
                    action: 'generate'
                },
                success: function(response) {
                    // Check if the response contains the specific message for "not generated"
                    if (response.includes('<i>Payslip for this payroll cycle not yet generated.</i>')) {
                        // Show the error message from PHP
                        Swal.fire({
                            icon: 'warning',
                            title: 'Payslip Not Available',
                            text: 'Payroll for this payroll cycle has not been generated yet.',
                        }).then(() => {
                            $('#payrollCycleID').prop('selectedIndex', 0);
                        });
                        $('#loader').hide();
                        $('#btnDownloadPayslip').hide();  // Hide button if payslip is not generated
                    } else {
                        // If response contains payslip HTML, display it
                        $('#loader').hide();
                        $('#payslipContainer').html(response).show();
                        $('#btnDownloadPayslip').show();  // Show the download button if payslip is valid
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                }
            });
        }
    });

    $(".downloadPayslip").click(function (e) {
        e.preventDefault();
    
        // Reference the payslip container
        var element = document.getElementById('payslipContainer');
    
        // Apply a temporary scaling class
        $(element).addClass('scale-for-pdf');
    
        html2pdf()
            .from(element)
            .set({
                margin: 0.5,
                filename: 'payslip.pdf',
                html2canvas: { scale: 3 }, // Keeps quality high
                jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }, // Adjust format and orientation
            })
            .save()
            .then(() => {
                // Remove the scaling class after the PDF is saved
                $(element).removeClass('scale-for-pdf');
    
                // Perform the AJAX call
                $.ajax({
                    url: '../backend/user/generatePayslip.php',
                    type: 'POST',
                    data: {
                        action: 'download',
                    },
                    success: function (response) {
                        console.log("AJAX call successful:", response);
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX call failed:", error);
                    },
                });
            });
    });
    
});