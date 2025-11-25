$(document).ready(function() {

    // $('#payrollTable').DataTable({
    //     scrollX: true,
    // });
    $('#payrollTable').DataTable();
    var payrollListTable = $('#payrollListTable').DataTable();
    payrollListTable.order([[0, "asc"]]).draw();

    // CREATE PAYROLL
    $("#addPayrollForm").submit(function (e) {
        e.preventDefault();

        let addPayrollForm = new FormData();
        var payrollCycleID = $('#payrollCycleID').val();

        if (payrollCycleID == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please select one payroll cycle',

            })
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Create Payroll',
                text: 'Are you sure you want to create this payroll cycle?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                addPayrollForm.append('payrollCycleID', payrollCycleID);
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/createPayroll.php",
                        data: addPayrollForm,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false,
                                }).then(() => {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message,
                                });
                            }
                        }
                    });
                }
            });
        }
    });
    
    // CALCULATE PAYROLL
    $('.calculatePayroll').click(function(e) {
        e.preventDefault();
        
        let addPayrollForm = new FormData();
        var payrollID = $(this).attr('data-id');
        var payrollCycleID = $(this).attr('data-cycleID');
        
        if (payrollID == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please select one payroll cycle',
            })
        }
        else {
            Swal.fire({
                icon: 'question',
                title: 'Calculate Payroll',
                text: 'Are you sure you want to create this payroll?',
                showCancelButton: true,
                cancelButtonColor: '#6c757d',
                confirmButtonColor: '#28a745',
                confirmButtonText: 'Yes',
            }).then((result) => {
                addPayrollForm.append('payrollID', payrollID);
                addPayrollForm.append('payrollCycleID', payrollCycleID);
                addPayrollForm.append('action', 'calculate');
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../backend/admin/calculatePayroll.php",
                        data: addPayrollForm,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            const data = JSON.parse(res);
                            var message = data.em;
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: message
                                }) 
                            }
                        }
                    });
                }
            });
        }
    });

    // VIEW PAYROLL
    $('.viewPayroll').click(function(e) {
        e.preventDefault();

        let viewPayrollForm = new FormData();
        var payrollID = $(this).data('id');
        var payrollCycleID = $(this).data('cycle');
        var payrollDateCreated = $(this).data('created');

        if (payrollID == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Required Information',
                text: 'Please select one payroll cycle',
            })
        }
        else {
            viewPayrollForm.append('payrollID', payrollID);
            viewPayrollForm.append('payrollCycleID', payrollCycleID);
            viewPayrollForm.append('payrollDateCreated', payrollDateCreated);
            viewPayrollForm.append('action', 'view');
            $.ajax({
                type: "POST",
                url: "../backend/admin/calculatePayroll.php",
                data: viewPayrollForm,
                contentType: false,
                processData: false,
                success: function (res) {
                    const data = JSON.parse(res);
                    var message = data.em;
                    if (data.error == 0) {
                        id = data.id;
                        cycleID = data.cycleID;
                        dateCreated = data.dateCreated;
                        window.location.href = "../pages/admin_calculatedPayroll.php?id=" + id + "&cycleID=" + payrollCycleID + "&dateCreated=" + payrollDateCreated;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: message
                        });
                    }
                }
            });
        }
    });

    // DELETE PAYROLL
    $('.deletePayroll').click(function(e) {
        e.preventDefault();

        let deletePayrollForm =  new FormData();
        var payrollID = $(this).data('id');
        
        Swal.fire({
            icon: 'question',
            title: 'Delete Payroll',
            text: 'Are you sure you want to delete this payroll?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../backend/admin/calculatePayroll.php",
                    type: 'POST',
                    data: {
                        payrollID: payrollID,
                        action: 'delete'
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        var message = res.em;
                        if (res.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            })
                        }
                    }
                })
            }
        })
        
    });

    // RECALCULATE PAYROLL
    $('.recalculatePayroll').click(function(e) {
        e.preventDefault();

        let recalculatePayrollForm = new FormData();
        var recal_payrollID = $(this).data('id');
        var recal_cycleID = $(this).data('cycle');
        
        console.log({recal_payrollID, recal_cycleID});
        
        Swal.fire({
            icon: 'question',
            title: 'Re-Calculate Payroll',
            text: 'Are you sure you want to re-calculate this payroll?',
            showCancelButton: true,
            cancelButtonColor: '#6c757d',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes',
        }).then((result) => {
            recalculatePayrollForm.append('payrollID', recal_payrollID);
            recalculatePayrollForm.append('payrollCycleID', recal_cycleID);
            recalculatePayrollForm.append('action', 'recalculate');
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../backend/admin/calculatePayroll.php",
                    data: recalculatePayrollForm,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        const data = JSON.parse(res);
                        var message = data.em;
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message
                            }) 
                        }
                    }
                });
            }
        })
    });
        
    // $(".exportPayroll").click(function () {
    //     let csvContent = "";
    //     let table = $("#payrollListTable").DataTable(); // Use DataTables API

    //     // Get ALL rows (not just visible ones)
    //     let allData = table.rows().data();

    //     allData.each(function (rowData) {
    //         let row = [];

    //         rowData.forEach(function (cell) {
    //         row.push('"' + cell + '"');
    //         });

    //         csvContent += row.join(",") + "\n";
    //     });

    //     // Download CSV
    //     const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    //     const url = URL.createObjectURL(blob);
    //     const link = document.createElement("a");

    //     link.href = url;
    //     link.download = "payroll.csv";
    //     link.click();

    //     URL.revokeObjectURL(url);
    // });

    $(".exportPayroll").click(function () {
        let table = $("#payrollListTable").DataTable();
        let allData = table.rows().data();
        let csvContent = "";

        // === TITLE ===
        const reportTitle = "Payroll Summary Report";
        csvContent += `"${reportTitle}"\n\n`;

        // === COLUMN HEADERS ===
        let headerRow = [];
        table
            .columns()
            .header()
            .each(function (th) {
            headerRow.push('"' + $(th).text().trim() + '"');
            });

        csvContent += headerRow.join(",") + "\n"; // Add to CSV

        // === ALL DATA ROWS ===
        allData.each(function (rowData) {
            // Skip rows containing "DEDUCTIONS"
            if (rowData.includes("DEDUCTIONS")) {
            return;
            }

            let row = [];
            rowData.forEach(function (cell) {
            row.push('"' + cell + '"');
            });

            csvContent += row.join(",") + "\n";
        });

        // === DOWNLOAD CSV ===
        const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");

        link.href = url;
        link.download = "payroll.csv";
        link.click();

        URL.revokeObjectURL(url);
    });


    $('#btnBack').click(function(e) {
        e.preventDefault();
        window.location.href = "../pages/admin_payroll.php";
    });
});