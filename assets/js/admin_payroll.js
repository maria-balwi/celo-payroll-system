$(document).ready(function() {

    // var payrollTable = $('#payrollTable').DataTable();
    // payrollTable.order([[1, "asc"]]).draw();
    $('#payrollTable').DataTable();
    $('#payrollListTable').DataTable();
    var payrollListTable = $('#payrollListTable').DataTable();
    payrollListTable.order([[0, "asc"]]).draw();

    // ADD USER
    $("#addPayrollForm").submit(function (e) {
        e.preventDefault();

        let addPayrollForm = new FormData();
        var payrollCycleID = $('#payrollCycleID').val();
        console.log({payrollCycleID});

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
    
    $('.calculatePayroll').click(function(e) {
        start_load();
        
    });
});