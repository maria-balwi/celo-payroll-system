$(document).ready(function() {

    // $('#auditTrailTable').DataTable();
    var employeeTable = $('#employeesTable').DataTable();
    employeeTable.order([[0, "desc"]]).draw();

    var payrollTable = $("#payrollTable").DataTable();
    payrollTable.order([[0, "desc"]]).draw();

    var leaveTable = $("#leaveTable").DataTable();
    leaveTable.order([[0, "desc"]]).draw();

    var changeShiftTable = $("#changeShiftTable").DataTable();
    changeShiftTable.order([[0, "desc"]]).draw();

    var overtimeTable = $("#overtimeTable").DataTable();
    overtimeTable.order([[0, "desc"]]).draw();

    var adjustmentsTable = $("#adjustmentsTable").DataTable();
    adjustmentsTable.order([[0, "desc"]]).draw();

    var usersTable = $("#usersTable").DataTable();
    usersTable.order([[0, "desc"]]).draw();

	
    // VIEW AND UPDATE SALARY ADJUSTMENTS
    var array = [];
    $(document).on('click', '.salaryAdjustmentView  ', function() {
        var salary_id = $(this).data('id');
        array.push(salary_id);
        var id_salary = array[array.length - 1];

        // VIEW SALARY ADJUSTMENTS
        $.ajax({
            type: "GET",
            url: "../backend/admin/salaryAdjustmentModal.php?salary_id=" + id_salary,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $("#viewDateFiled").val(formatDate(res.data.dateFiled));
                    $("#viewStatus").val(res.data.status);
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewEmployeeName").val(res.data.firstName + " " + res.data.lastName);
                    $("#viewCurrentSalary").val("₱ " + formatNumberWithCommas(res.data.basicPay));
                    $("#viewSuggestedSalary").val("₱ " + formatNumberWithCommas(res.data.suggestedSalary - res.data.basicPay));
                    $("#viewReason").val(res.data.reason);

                    $("#viewSalaryAdjustmentModal").modal("show");
                }
            }
        });
    });
});