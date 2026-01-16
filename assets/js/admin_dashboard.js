$(document).ready(function() {

    var recentlyAddedEmployeesTable = $('#recentlyAddedEmployeesTable').DataTable();
    recentlyAddedEmployeesTable.order([[0, "desc"]]).draw();
    
});