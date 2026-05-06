function formatDate(dateStr) {
    if (!dateStr) return '';

    var dateObj = new Date(dateStr);

    return dateObj.toLocaleDateString("en-US", {
        month: "short",
        day: "2-digit",
        year: "numeric"
    });
}

function formatNumberWithCommas(number) {
    number = parseFloat(number);
    if (isNaN(number)) return "0.00";
    return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

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

    var disputesTable = $("#disputesTable").DataTable();
    disputesTable.order([[0, "desc"]]).draw();

    var usersTable = $("#usersTable").DataTable();
    usersTable.order([[0, "desc"]]).draw();

    var notificationsTable = $("#notificationsTable").DataTable();
    notificationsTable.order([[0, "desc"]]).draw();
    
    var passwordResetTable = $("#passwordResetTable").DataTable();
    passwordResetTable.order([[0, "desc"]]).draw();

    var payslipTable = $("#payslipTable").DataTable();
    payslipTable.order([[0, "desc"]]).draw();

    var logsTable = $("#logsTable").DataTable();
    logsTable.order([[0, "desc"]]).draw();
	
    // VIEW AND UPDATE SALARY ADJUSTMENTS
    var array = [];
    $(document).on('click', '.salaryAdjustmentView  ', function() {
        var salaryadj_id = $(this).data('id');
        array.push(salaryadj_id);
        var id_salaryadj = array[array.length - 1];

        // VIEW SALARY ADJUSTMENTS
        $.ajax({
            type: "GET",
            url: "../backend/admin/salaryAdjustmentModal.php?salaryadj_id=" + id_salaryadj,
            success: function(response) {

                var res = jQuery.parseJSON(response);

                if (res.status == 404) {
                    alert(res.message);
                } 
                else if (res.status == 200) {
                    $("#viewAction").val(res.data.action);
                    $("#viewUser").val(res.data.firstName + " " + res.data.lastName);
                    $("#viewDateFiled").val(formatDate(res.data.dateFiled));
                    $("#viewEmployeeID").val(res.data.employeeID);
                    $("#viewReason").val(res.data.reason);
                    $("#viewEmployeeName").val(res.data.affectedFirstName + " " + res.data.affectedLastName);
                    $("#viewCurrentSalary").val("₱ " + formatNumberWithCommas(res.data.currentSalary));
                    $("#viewSuggestedSalary").val("₱ " + formatNumberWithCommas(res.data.suggestedSalary));
                    $("#viewReason").val(res.data.reason);

                    $("#viewSalaryAdjustmentModal").modal("show");
                }
            }
        });
    });
});