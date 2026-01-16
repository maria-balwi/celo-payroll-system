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
});