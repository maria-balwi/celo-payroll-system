$(document).ready(function() {

    // $('#auditTrailTable').DataTable();
    var auditTrailTable = $('#auditTrailTable').DataTable();
    auditTrailTable.order([[0, "desc"]]).draw();
});