$(document).ready(function() {

    $('#payslipTable').DataTable();
    $('#btnPrintPayslip').hide();
    $('#btnDownloadPayslip').hide(); 

    var id;

    $('.generatePayslip').click(function(e) {
        e.preventDefault();
        var payrollCycleID = $('#payrollCycleID').val();
        id = $(this).data('id');
        console.log({id});

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
                        $('#btnDownloadPayslip').hide();
                    } else {
                        // If response contains payslip HTML, display it
                        $('#loader').hide();
                        $('#payslipContainer').html(response).show();
                        $("#btnDownloadPayslip").show();

                        // if (id == 8 || id == 9) {
                        //     // $('#btnPrintPayslip').show();
                        //     $('#btnDownloadPayslip').show();
                        // }
                        // else {
                        //     // $('#btnPrintPayslip').show();
                        //     $('#btnDownloadPayslip').hide();
                        // }
                        // $('#btnDownloadPayslip').show();  // Show the download button if payslip is valid
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

        var watermark = document.createElement('div');
        watermark.innerText = 'Confidential';
        watermark.className = 'absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-red-500 font-bold text-4xl opacity-20 rotate-45 pointer-events-none';
        element.appendChild(watermark);
    
        html2pdf()
            .from(element)
            .set({
                margin: [20, 20, 20, 20],
                filename: 'payslip.pdf',
                html2canvas: { 
                    scale: 3, 
                    useCORS: true,
                    scrollY: 0
                }, // Keeps quality high
                jsPDF: { 
                    unit: 'pt', 
                    format: 'a4', 
                    orientation: 'portrait' 
                }, // Adjust format and orientation
            })
            .save()
            .then(() => {
                // Remove the scaling class after the PDF is saved
                $(element).removeClass('scale-for-pdf');
                watermark.remove();
    
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