$(document).ready(function() {

    // var payrollTable = $('#payrollTable').DataTable();
    // payrollTable.order([[1, "asc"]]).draw();
    $('#payrollTable').DataTable();
    
    $('.calculatePayroll').click(function(e) {
        start_load();
        
    });
});